<?php

namespace App\Modules\User\Controllers;

use App\Events\PaymentCreated;
use App\Events\SendNotificationEvent;
use App\Events\SendNotificationUser;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Group;
use App\Models\Province;
use App\Models\RequestWithdrawal;
use App\Models\UserBank;
use App\Models\Service;
use App\Models\TransactionHistory;
use App\Models\User;
use App\Models\UserCode;
use App\Modules\User\Requests\StoreRequest;
use App\Modules\User\Requests\StoreUserCode;
use App\Modules\User\Requests\UpdateRequest;
use App\Modules\User\Requests\UpdateUserCode;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class UserController extends Controller {

    protected UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        View::share('provinces', Province::all());
        View::share('services', Service::all());
    }
    public function index(Request $request)
    {
        $users = $this->userService->getUsers();
        $page = $request->page ?? 1;
        return view('User::manager.index', compact('users', 'page'));
    }
    public function indexCode()
    {
        $users = $this->userService->getUserCodes();
        return view('User::manager.index_user_code', compact('users'));
    }

    public function code(){
        return view('User::manager.create_user_code');
    }

    public function storeCode(StoreUserCode $request)
    {
        $data = $request->all();
        $data['created_by'] = auth()->id();
        $data['code'] = $request->user_code;
        UserCode::create($data);
        return redirect()->route('admin.user.index.code');
    }

    public function create()
    {
        $last_code = User::whereRaw('CAST(SUBSTRING(user_code, 3) AS UNSIGNED) IS NOT NULL')
            ->orderByRaw('CAST(SUBSTRING(user_code, 3) AS UNSIGNED) DESC')
            ->first();
        if ($last_code) {
            $last_number = intval(substr($last_code->user_code, 2));
        } else {
            $last_number = 0;
        }
        $last_number++;
        $random_code = str_pad($last_number, 6, '0', STR_PAD_LEFT);
        return view('User::manager.create', compact('random_code'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $data['is_currency']  = 'VNĐ';
        $data['password'] = Hash::make($data['password']);
        $data['service_id'] = 4;
        $data['status_service_id'] = 1;
        $service = Service::where('id', $data['service_id'])->first();
        $duration_service = $service->duration;
        if($service->duration_type == 'day'){
            $data['duration'] = Carbon::now()->addDays($duration_service)->format('Y-m-d');
        } else {
            $data['duration'] = Carbon::now()->addMonths($duration_service)->format('Y-m-d');
        }
        $this->userService->createUser($data);
        return redirect()->route('admin.user.index');
    }

    public function edit($id)
    {
        $user = $this->userService->getUserById((int)$id);
        $service_id = Service::select('*')->where('duration', '>', 0)->get();
        $groups = Group::select('*')->get();
        $banks = Bank::all();
        return view('User::manager.edit', [
            'user' => $user,
            'service_id' => $service_id,
            'groups' => $groups,
            'banks' => $banks,
        ]);
    }
    public function editCode($id)
    {
        $user = UserCode::where('id', $id)->first();
        return view('User::manager.edit_user_code', compact('user'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $data = $request->all();
        $user = $this->userService->updateUser($id, $data);
        if (!$user->duration instanceof \DateTime) {
            $user->duration = new \DateTime($user->duration);
        }
        $formattedDuration = $user->duration->format('d/m/Y');
        if($user->service){
            $message = 'Bạn đã được nâng lên thành viên ' . $user->service->name . ' của dropii với thời hạn ' . $formattedDuration;
            event(new PaymentCreated($message, $user->id));
            SendNotificationUser(
                $user,
                $message,
                [
                    'title' => 'Thông báo',
                    'type' => '1',
                    'url' => route('profile.index'),
                    'data' => json_encode([]),
                    'user_id' => $user->id,
                    'is_read' => 0,
                    'sent_at' => now(),
                ]
            );
        }
        return redirect()->route('admin.user.index')->with('success', 'Cập nhật thành công');
    }

    public function updateCode(UpdateUserCode $request, $id)
    {
        $data = $request->except(['_token', '_method']);
        $user_code = UserCode::where('id', $id)->first();
        $data['code'] = $request->user_code;
        $user_code->update($data);
        return redirect()->route('admin.user.index.code')->with('success', 'Cập nhật thành công');
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        $newTransaction = TransactionHistory::where('user_id', $id)->latest()
        ->first();
        $service_id = Service::select('*')->where('duration', '>', 0)->get();
        $groups = Group::select('*')->get();
        $user_bank = UserBank::where('userId', $id)->first();
        return view('User::manager.detail', compact('user', 'service_id', 'groups','user_bank','newTransaction'));
    }

    public function delete($id)
    {
        $this->userService->deleteUser($id);
        return redirect()->route('admin.user.index');
    }

    public function deleteCode($id)
    {
        $this->userService->deleteUserCode($id);
        return redirect()->route('admin.user.index.code');
    }

    public function getPercent($id)
    {
        $user = $this->userService->getUserById($id);
        if ($user) {
            if ($user->service) {
                $percent = $user->service->percent;
                return $percent ?? 0;
            }
        }
        return 0;
    }

    public function transactionHistory(Request $request)
    {
        $user_id = $request->user_id;
        if(!$user_id){
            return response()->json(['status' => 'error']);
        }
        $user = User::find($user_id);
        $transactionHistories = TransactionHistory::where('user_id', $user_id);
        $page = $request->page ?? 1;
        $pagesize = 5;
        $totalRecord = $transactionHistories->count();
        $pageMax = ceil($totalRecord / $pagesize);
        $list_history_transaction = $transactionHistories->orderBy('created_at', 'desc')
            ->skip(($page - 1) * $pagesize)
            ->take($pagesize)
            ->get();

        $totalReward = $transactionHistories->sum('amount_reward');
        $totalPunish = $transactionHistories->sum('amount_punish');
        $totalWithdrawCash = $transactionHistories->sum('withdraw_cash');
        return view('User::manager.list_history_transaction',[
            'user' => $user,
            'list_history_transaction' => $list_history_transaction,
            'page' => $page,
            'pagesize' => $pagesize,
            'totalRecord' => $totalRecord,
            'pageMax' => $pageMax,
            'totalReward' => formatCurrency2($totalReward).' '.  $user->getCurrency(),
            'totalPunish' => formatCurrency2($totalPunish).' '.  $user->getCurrency(),
            'totalWithdrawCash' => formatCurrency2($totalWithdrawCash).' '.  $user->getCurrency(),
            'userRevenueVN' => formatCurrency($user->userRevenue()),
            'userRevenue' => $user->userRevenueWon(),
            'userRevenueFormat' => formatCurrency2($user->userRevenueWon()).' '.$user->getCurrency(),
        ]);
    }
    public function requestWithdrawal(Request $request){
        $user_id = $request->user_id;
        if(!$user_id){
            return response()->json(['status' => 'error']);
        }
        $user = User::find($user_id);
        $requestDrawal = RequestWithdrawal::where('user_id', $user_id)->where('status', 'request');
        $page = $request->page ?? 1;
        $pagesize = 5;
        $totalRecord = $requestDrawal->count();
        $pageMax = ceil($totalRecord / $pagesize);
        $list_request_withdrawals = $requestDrawal->orderBy('created_at', 'desc')
            ->skip(($page - 1) * $pagesize)
            ->take($pagesize)
            ->get();
        return view('User::manager.list_request_withdrawals',[
            'user' => $user,
            'list_request_withdrawals' => $list_request_withdrawals,
            'page' => $page,
            'pagesize' => $pagesize,
            'totalRecord' => $totalRecord,
            'pageMax' => $pageMax,
            'userRevenueVN' => formatCurrency($user->userRevenue()),
            'userRevenue' => $user->userRevenueWon(),
            'userRevenueFormat' => formatCurrency2($user->userRevenueWon()).' '.$user->getCurrency(),
        ]);
    }

    public function confirmRequestWithdrawal(Request $request){
        $requestWithdrawal = RequestWithdrawal::where('id',$request->id)->first();
        $user = User::find($requestWithdrawal->user_id);
        SendNotificationUser(
            $user,
            'Bạn vừa được thanh toán ' . formatMoneyWon(str_replace(',', '', $requestWithdrawal->amount)) . ' ' . $user->getCurrency() .' từ dropii',
            [
                'title' => 'Yêu cầu rút tiền thành công',
                'type' => '1',
                'url' => '',
                'data' => json_encode([]),
                'user_id' => $user->id,
                'is_read' => 0,
                'sent_at' => now(),
            ]
        );
        $requestWithdrawal->update([
            'status' => 'success',
        ]);
        return response()->json(['status' => 'success']);
    }
    public function cancelRequestWithdrawal(Request $request){
        $requestWithdrawal = RequestWithdrawal::where('id',$request->id)->first();
        $user = User::find($requestWithdrawal->user_id);
        TransactionHistory::where('created_at', '=',$requestWithdrawal->created_at)->delete();
            $requestWithdrawal->update([
                'status' => 'refuse',
            ]);
            SendNotificationUser(
                $user,
                'Yêu cầu rút tiền không được xác nhận từ dropii!',
                [
                    'title' => 'Yêu cầu rút tiền không thành công',
                    'type' => '1',
                    'url' => '',
                    'data' => json_encode([]),
                    'user_id' => $user->id,
                    'is_read' => 0,
                    'sent_at' => now(),
                    'money' => formatMoneyWon($user->userRevenueWon()),
                ]
            );
        return response()->json(['status' => 'success']);
    }
    public function transactionHistoryStore(Request $request){
        $user_id = $request->user_id;
        if(!$user_id){
            return response()->json(['status' => 'error']);
        }
        $transaction = $request->transaction;
        $type = $request->type;
        $user = User::find($user_id);
        if($transaction == 'rewardOrPenalty'){
            $user->TransactionHistory()->create([
                'amount_reward' => $type == 'reward' ? str_replace(',', '', $request->rewardOrPenaltyAmount) : 0,
                'amount_punish' => $type == 'penalty' ? str_replace(',', '', $request->rewardOrPenaltyAmount) : 0,
                'currency' => $user->getCurrency(),
            ]);
            SendNotificationUser(
                $user,
                'Bạn vừa ' . ($type == 'reward' ? 'được thưởng' : 'bị phạt') . ' ' . formatCurrency2(str_replace(',', '', $request->rewardOrPenaltyAmount)) . ' ' . $user->getCurrency() .'  từ dropii',
                [
                    'title' => 'Thông báo',
                    'type' => '1',
                    'url' => '',
                    'data' => json_encode([]),
                    'user_id' => $user->id,
                    'is_read' => 0,
                    'sent_at' => now(),
                ]
            );
        }
        if($transaction == 'payToAgency'){
            $userRevenue = $user->userRevenueWon();
            if(
                $userRevenue < str_replace(',', '', $request->rewardOrPenaltyAmount) && $transaction == 'rewardOrPenalty' && $type == 'penalty' ||
                $userRevenue < str_replace(',', '', $request->payToAgencyAmount) && $transaction == 'payToAgency'
            ){
                return response()->json(['status' => 'error', 'message' => 'Số dư không đủ']);
            }
            $path = null;
            if($request->hasFile('file')){
                $path = Storage::disk('public')->put('transaction', $request->file('file'));
            }
            $user->TransactionHistory()->create([
                'withdraw_cash' => str_replace(',', '', $request->payToAgencyAmount) ?? 0,
                'file' => $path,
                'note' => 'Thanh toán cho đại lý',
                'currency' => $user->getCurrency(),
            ]);
            SendNotificationUser(
                $user,
                'Bạn vừa được thanh toán ' . formatMoneyWon(str_replace(',', '', $request->payToAgencyAmount)) . ' ' . $user->getCurrency() .' từ dropii',
                [
                    'title' => 'Thông báo',
                    'type' => '1',
                    'url' => '',
                    'data' => json_encode([]),
                    'user_id' => $user->id,
                    'is_read' => 0,
                    'sent_at' => now(),
                ]
            );

        }
        if($transaction == 'RequestWithdrawal'){
            $path = null;
            if($request->hasFile('file')){
                $path = Storage::disk('public')->put('transaction', $request->file('file'));
            }
            TransactionHistory::where('id', $request->transactionId)->update([
                'file' => $path,
            ]);
            SendNotificationUser(
                $user,
                'Bạn vừa được thanh toán ' . formatMoneyWon(str_replace(',', '', $request->RequestWithdrawalAmount)) . ' ' . $user->getCurrency() .' từ dropii',
                [
                    'title' => 'Yêu cầu rút tiền thành công',
                    'type' => '1',
                    'url' => '',
                    'data' => json_encode([]),
                    'user_id' => $user->id,
                    'is_read' => 0,
                    'sent_at' => now(),
                ]
            );
            $user->RequestWithdrawal->where('status', 'request')->first()->update([
                'status' => 'success',
            ]);
        }
        if($transaction == 'CancelRequestWithdrawal'){
            
            TransactionHistory::where('id', $request->transaction_id)->delete();
            $user->RequestWithdrawal->where('status', 'request')->first()->update([
                'status' => 'refuse',
            ]);
            SendNotificationUser(
                $user,
                'Yêu cầu rút tiền không được xác nhận từ dropii!',
                [
                    'title' => 'Yêu cầu rút tiền không thành công',
                    'type' => '1',
                    'url' => '',
                    'data' => json_encode([]),
                    'user_id' => $user->id,
                    'is_read' => 0,
                    'sent_at' => now(),
                ]
            );
           
        }
        return response()->json(['status' => 'success']);
    }

    public function upgradeIndex(){
        $services = Service::all();
        return view('User::upgrade.index', compact('services'));
    }
    public function upgradeEdit($id){
        $service = Service::where('id', $id)->first();
        return view('User::upgrade.edit', compact('service'));
    }
    public function upgradeUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'duration_type' => 'required|string',
            'percent' => 'nullable|numeric|min:0|max:100', 
            'slug' => 'nullable', 
        ], [
            'name.required' => 'Tên gói nâng cấp không được để trống.',
            'name.string' => 'Tên gói nâng cấp phải là một chuỗi ký tự.',
            'name.max' => 'Tên gói nâng cấp không được vượt quá :max ký tự.',
            'price.required' => 'Giá gói nâng cấp không được để trống.',
            'price.numeric' => 'Giá gói nâng cấp phải là một số.',
            'duration.required' => 'Thời gian hết hạn không được để trống.',
            'duration.numeric' => 'Thời gian hết hạn phải là một số.',
            'duration_type.required' => 'Loại thời gian không được để trống.',
            'duration_type.string' => 'Loại thời gian phải là một chuỗi ký tự.',
            'percent.numeric' => 'Chiết khấu phải là một số.',
            'percent.min' => 'Chiết khấu không được nhỏ hơn :min.',
            'percent.max' => 'Chiết khấu không được lớn hơn :max.',
        ]);

        $service = Service::findOrFail($id);
        $service->name = $validated['name'];
        $service->slug = $validated['slug'];
        $service->price = $validated['price'];
        $service->duration = $validated['duration'];
        $service->duration_type = $validated['duration_type'];
        $service->percent = $validated['percent'] ?? 0;
        $service->save();

        // Redirect or return a response after update
        return redirect()->route('admin.user.upgrade')
            ->with('success', 'Gói nâng cấp đã được cập nhật thành công');
    }
}
