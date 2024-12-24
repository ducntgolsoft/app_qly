@extends('Layout.Manager')
@push('css')
@endpush
@section('content')
    <div class="bg-gray-100">
        <div class="container mx-auto py-8">
            @php
                $RequestWithdrawalAmount = $user->RequestWithdrawal->where('status', 'request')->first();
                $RequestWithdrawalAmount = $RequestWithdrawalAmount->amount ?? 0;
            @endphp
            @if ($user->checkRequestWithdrawal() > 0)
                <div class="mx-4 mb-7 bg-blue-100 border border-blue-200 text-sm text-blue-800 rounded-lg dark:bg-blue-800/10 dark:border-blue-900 dark:text-blue-500"
                    role="alert" tabindex="-1" aria-labelledby="hs-toast-soft-color-blue-label">
                    <div id="hs-toast-soft-color-blue-label" class="flex p-4 font-semibold">
                        Đại lý đang yêu cầu rút tiền,&nbsp;<span class="font-bold cursor-pointer" type="button"
                            aria-haspopup="dialog" aria-expanded="false" aria-controls="RequestWithdrawal"
                            data-hs-overlay="#RequestWithdrawal">Thanh toán ngay</span>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
                <div class="col-span-4 sm:col-span-3">
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="flex flex-col items-center">
                            @if ($user->image == null)
                                <img src="/assets/img/user.png"
                                    class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0 object-cover" />
                            @else
                                <img src="{{ env('STORAGE_URL', '/storage/') }}{{ $user->image }}"
                                    class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0" />
                            @endif
                            <h1 class="text-xl font-bold">
                                {{ $user->name ?? '' }}
                            </h1>
                            <p class="text-gray-700">{{ $user->service->name ?? '' }}</p>
                            <div class="mt-4 flex flex-wrap gap-4 justify-center">
                                @if ($user->status == 0)
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">Khó</span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500">Hoạt
                                        động</span>
                                @endif
                            </div>
                        </div>
                        <a href="/admin/user/edit/{{ $user->id }}"><button
                                class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 mt-6 mx-auto flex justify-center items-center space-x-2"><i
                                    class="fa-regular fa-pen-to-square"></i>&nbsp;Sửa thông tin</button></a>
                        <hr class="mt-2 mb-6 border-t border-gray-300">
                        <div class="flex flex-col">
                            <span class="text-gray-700 uppercase font-bold tracking-wider mb-2">Session</span>
                            <span>{{ $user->last_login_ip ?? '' }}</span>
                            @if ($user->last_login_at)
                                <span>{{ formatDateHIS($user->last_login_at) }}</span>
                            @endif
                        </div>
                        <hr class="my-6 border-t border-gray-300">
                        <div class="flex flex-col">
                            <button type="button" aria-haspopup="dialog" aria-expanded="false" aria-controls="payToAgency"
                                data-hs-overlay="#payToAgency"
                                class="transition text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Thanh
                                toán cho đại lý</button>
                            <button type="button" aria-haspopup="dialog" aria-expanded="false"
                                aria-controls="rewardOrPenalty" data-hs-overlay="#rewardOrPenalty"
                                class="mb-2 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2">Thưởng
                                / Phạt</button>
                        </div>
                    </div>
                </div>
                <div class="col-span-4 sm:col-span-9">
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-xl font-bold mb-4 underline">Chi tiết</h2>
                        <div class="grid md:gap-2 mb-6 md:grid-cols-2 grid-cols-1 px-3 mt-2">
                            <div class="md:border-r-2 md:pr-2">
                                <div class="my-2"><span class="font-semibold">Họ tên :</span>
                                    <span class="font-bold ">{{ $user->name ?? '' }}</span>
                                </div>

                                <div class="my-2"><span class="font-semibold">Số điện thoại:</span>
                                    <span>{{ $user->phone ?? '' }}</span>
                                </div>
                                <div class="my-2"><span class="font-semibold"> Group:</span>
                                    <span>{{ $user->group->name ?? '' }}</span>
                                </div>
                                <div class="my-2"><span class="font-semibold">Dịch vụ:</span>
                                    <span>{{ $user->service->name ?? '' }}</span>
                                </div>

                            </div>
                            <div class="md:px-2">
                                <div class="my-2"><span class="font-semibold">Mã đại lý:</span>
                                    <span>{{ $user->user_code ?? '' }}</span>
                                </div>
                                <div class="my-2"><span class="font-semibold">Email :</span>
                                    <span>{{ $user->email ?? '' }}</span>
                                </div>

                                <div class="my-2"><span class="font-semibold">Vai trò :</span>
                                    <span>{{ $user->role ?? '' }}</span>

                                </div>
                                <div class="my-2"><span class="font-semibold">Hạn sử dụng tài khoản:</span>
                                    <span class="font-bold "> {{ formatDate($user->duration) ?? '' }}</span>
                                </div>
                                <div class="my-2"><span class="font-semibold">Hoa hồng:</span>
                                    <span class="font-bold "> {{ $user->getPercent() ?? '' }}%</span>
                                </div>
                            </div>

                        </div>

                        <h2 class="text-xl font-bold mt-6 mb-4 underline">Thông tin thanh toán</h2>
                        <div class="grid gap-2 mb-6 md:grid-cols-2 grid-cols-1 px-3 mt-2">
                            <div class="md:border-r-2 md:pr-2">
                                <div class="my-2"><span class="font-semibold">Ngân hàng :</span>
                                    <span class="font-bold ">{{ $user_bank->name_bank ?? '' }}</span>
                                </div>

                                <div class="my-2"><span class="font-semibold">Tên chủ tài khoản:</span>
                                    <span>{{ $user_bank->name_account ?? '' }}</span>
                                </div>
                            </div>
                            <div class="md:px-2 pr-2">
                                <div class="my-2"><span class="font-semibold">Chi nhánh:</span>
                                    <span>{{ $user_bank->bank_branch ?? '' }}</span>
                                </div>
                                <div class="my-2"><span class="font-semibold">Số tài khoản :</span>
                                    <span>{{ $user_bank->number_account ?? '' }}</span>
                                </div>
                            </div>
                        </div>

                        <h2 class="text-xl font-bold mt-6 mb-4 underline">Thông tin đơn hàng</h2>
                        <div class="grid gap-2 mb-6 md:grid-cols-2 grid-cols-1 px-3 mt-2">
                            <div class="md:border-r-2 md:pr-2">
                                <div class="my-2"><span class="font-semibold">Tổng số đơn hàng :</span>
                                    <span class="font-bold ">{{ $user->getTotalOrder() }}</span>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2">
                                <div class="col-span-2">
                                    <div class="my-2 flex items-center">
                                        <span class="font-bold mr-4">Doanh số:</span>
                                        <div class="grid grid-cols-1 md:grid-cols-2">
                                            <span class="border-r pr-4">{{ formatCurrency($user->getTotal()) }}</span>
                                            <span class="pl-4">{{ formatCurrency2($user->getTotalWon()) }}
                                                {{ $user->getCurrency() }}</span>
                                        </div>
                                    </div>
                                    <div class="my-2 flex items-center">
                                        <span class="font-bold mr-4">Hoa hồng:</span>
                                        <div class="grid grid-cols-1 md:grid-cols-2">
                                            <span class="border-r pr-4">{{ formatCurrency($user->getRevenue()) }}</span>
                                            <span class="pl-4">{{ formatCurrency2($user->getRevenueWon()) }}
                                                {{ $user->getCurrency() }}</span>
                                        </div>
                                    </div>
                                    <div class="my-2 flex items-center">
                                        <span class="font-bold mr-4">Lợi nhuận:</span>
                                        <div class="grid grid-cols-1 md:grid-cols-2">
                                            <span
                                                class="border-r pr-4 userRevenueVN">{{ formatCurrency($user->userRevenue()) }}</span>
                                            <span class="pl-4 userRevenue">{{ formatCurrency2($user->userRevenueWon()) }}
                                                {{ $user->getCurrency() }}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <h2 class="text-xl font-bold mt-6 mb-4 underline">Lịch sử giao dịch</h2>
                        <div class="flex flex-col bg-white dark:bg-gray-800 shadow-md rounded-lg"
                            id="renderTransactionHistory">
                            <div class="flex justify-center items-center my-4">
                                <div>
                                    <i class="fa-solid fa-circle-notch fa-spin"></i>
                                </div>
                                &nbsp;Đang lấy dữ liệu ...
                            </div>
                        </div>
                        <h2 class="text-xl font-bold mt-6 mb-4 underline">Yêu cầu rút tiền </h2>
                        <div class="flex flex-col bg-white dark:bg-gray-800 shadow-md rounded-lg"
                            id="renderRequestWithdrawal">
                            <div class="flex justify-center items-center my-4">
                                <div>
                                    <i class="fa-solid fa-circle-notch fa-spin"></i>
                                </div>
                                &nbsp;Đang lấy dữ liệu ...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="payToAgency"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="payToAgency-label">
        <div
            class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
            <div
                class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                    <h3 id="payToAgency-label" class="font-bold text-gray-800 dark:text-white">
                        Thanh toán cho đại lý
                    </h3>
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#payToAgency">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <p class="mt-1 text-gray-800 dark:text-neutral-400">
                        Tên đại lý: <span class="font-semibold">{{ $user->name ?? '' }}</span>
                    </p>
                    <p class="mt-1.5 text-gray-800 dark:text-neutral-400">
                        Tổng số tiền thanh toán: <span
                            class="font-semibold userRevenue">{{ formatCurrency2($user->userRevenueWon()) }}</span>
                    </p>
                    <div class="mt-2">
                        <p class="mt-1 text-gray-800 dark:text-neutral-400">
                            Thanh toán cho đại lý:
                        </p>
                        <div class=" space-y-3 mt-1">
                            <div>
                                <div class="relative">
                                    <input type="text" id="payToAgencyMoney" onkeyup="formatCurrency2(this)"
                                        name="payToAgencyMoney"
                                        value="{{ $user->userRevenueWon() > 0 ? formatCurrency2($user->userRevenueWon()) : '' }}"
                                        class="py-3 px-4 pe-16 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="0">
                                    <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none z-20 pe-4">
                                        <span
                                            class="text-gray-500 dark:text-neutral-500">{{ $user->getCurrency() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 mb-2">
                        <p class="mt-1 text-gray-800 dark:text-neutral-400">
                            Ảnh giao dịch:
                        </p>
                        <div class=" space-y-3 mt-1">
                            <input type="file" name="payToAgencyFile" id="payToAgencyFile"
                                class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                            file:bg-gray-50 file:border-0
                            file:me-4
                            file:py-3 file:px-4
                            dark:file:bg-neutral-700 dark:file:text-neutral-400">
                        </div>
                    </div>
                </div>
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        data-hs-overlay="#payToAgency">
                        Huỷ
                    </button>
                    <button type="button" onclick="payToAgency()"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        Xác nhận
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="rewardOrPenalty"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="rewardOrPenalty-label">
        <div
            class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
            <div
                class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                    <h3 id="rewardOrPenalty-label" class="font-bold text-gray-800 dark:text-white">
                        Thưởng / Phạt
                    </h3>
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#rewardOrPenalty">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <p class="mt-1 text-gray-800 dark:text-neutral-400">
                        Tên đại lý: <span class="font-semibold">{{ $user->name ?? '' }}</span>
                    </p>
                    <p class="mt-1.5 text-gray-800 dark:text-neutral-400">
                    <div class="flex gap-x-6 mt-2">
                        <div class="flex">
                            <input type="radio" name="rewardOrPenalty" value="reward"
                                class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                id="rewardOrPenalty-1" checked="">
                            <label for="rewardOrPenalty-1"
                                class="text-sm text-gray-500 ms-2 dark:text-neutral-400">Thưởng</label>
                        </div>

                        <div class="flex">
                            <input type="radio" name="rewardOrPenalty" value="penalty"
                                class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                id="rewardOrPenalty-2">
                            <label for="rewardOrPenalty-2"
                                class="text-sm text-gray-500 ms-2 dark:text-neutral-400">Phạt</label>
                        </div>
                    </div>
                    </p>
                    <div class="mt-2">
                        <p class="mt-1 text-gray-800 dark:text-neutral-400">
                            Số tiền
                        </p>
                        <div class=" space-y-3 mt-1">
                            <div>
                                <div class="relative">
                                    <input type="text" id="rewardOrPenaltyAmount" onkeyup="formatCurrency2(this)"
                                        name="rewardOrPenaltyAmount"
                                        class="py-3 px-4 pe-16 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="0">
                                    <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none z-20 pe-4">
                                        <span
                                            class="text-gray-500 dark:text-neutral-500">{{ $user->getCurrency() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        data-hs-overlay="#rewardOrPenalty">
                        Huỷ
                    </button>
                    <button type="button" onclick="rewardOrPenalty()"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        Xác nhận
                    </button>
                </div>
            </div>
        </div>
    </div>




    <input type="hidden" id="userRevenueMoney" value="{{ $user->userRevenue() }}">
    <input type="hidden" id="userRevenueMoneyWon" value="{{ $user->userRevenueWon() }}">
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            fetchTransactionHistory();
            fetchRequestWithdrawal();
            $(document).on('click', '#pagination_list button', function() {
                if ($(this).attr('disabled')) {
                    Swal.fire({
                        title: 'Thông báo',
                        text: 'Không thể chuyển trang',
                        icon: 'warning',
                        confirmButtonText: 'Đóng'
                    });
                }
                try {
                    if ($(this).hasClass('disabled')) {
                        //nothing
                    } else {
                        var page = $(this).attr('page');
                        fetchTransactionHistory(page);
                        fetchRequestWithdrawal(page)
                    }
                } catch (e) {
                    // alert('.pagination li' + e.message);
                }
            });

            $('input[type=radio][name=type]').change(function() {
                $(this).addClass('border-gray-200 focus:border-blue-500 focus:ring-blue-500').removeClass(
                    'border-red-500 focus:border-red-500 focus:ring-red-500');
                $('#errorRequestWithdrawalAmount').text('');
                if (this.value == 'all') {
                    $('#RequestWithdrawalAmount').val(
                        '{{ $RequestWithdrawalAmount > 0 ? formatCurrency2($RequestWithdrawalAmount) : '' }}'
                    );
                    $('#RequestWithdrawalAmount').prop('readonly', true);
                } else if (this.value == 'part') {
                    $('#RequestWithdrawalAmount').val('');
                    $('#RequestWithdrawalAmount').prop('readonly', false);
                }
            });

            $('#RequestWithdrawalAmount').keyup(function() {
                if ($('input[type=radio][name=type]:checked').val() == 'all') {
                    return;
                }
                if (this.value == '') {
                    return;
                }
                var value = this.value.replace(/,/g, '');
                if (isNaN(value)) {
                    $(this).addClass('border-red-500 focus:border-red-500 focus:ring-red-500').removeClass(
                        'border-gray-200 focus:border-blue-500 focus:ring-blue-500');
                    $('#errorRequestWithdrawalAmount').text('Số tiền không hợp lệ');
                    return;
                }
                if (parseInt(value) <= 0) {
                    $(this).addClass('border-red-500 focus:border-red-500 focus:ring-red-500').removeClass(
                        'border-gray-200 focus:border-blue-500 focus:ring-blue-500');
                    $('#errorRequestWithdrawalAmount').text('Số tiền phải lớn hơn 0');
                    return;
                }
                $('#confirmRequest').prop('disabled', false);
                $(this).addClass('border-gray-200 focus:border-blue-500 focus:ring-blue-500').removeClass(
                    'border-red-500 focus:border-red-500 focus:ring-red-500');
                $('#errorRequestWithdrawalAmount').text('');
                var maxPrice = {{ $RequestWithdrawalAmount > 0 ? $RequestWithdrawalAmount : 0 }}
                formatCurrency2(this)
                if (parseInt(value) > maxPrice) {
                    $(this).addClass('border-red-500 focus:border-red-500 focus:ring-red-500').removeClass(
                        'border-gray-200 focus:border-blue-500 focus:ring-blue-500');
                    $('#errorRequestWithdrawalAmount').text(
                        'Số tiền thanh toán không được lớn hơn số tiền yêu cầu');
                }
            });
        });

        function fetchTransactionHistory(page = 1) {
            instance.post("{{ route('admin.user.transactionHistory') }}", {
                page: page,
                user_id: '{{ $user->id }}'
            }).then(response => {
                $('#renderTransactionHistory').html(response.data);
                $('tfoot').removeClass('hidden');
            }).catch(error => {
                $('#renderTransactionHistory').html(`
                <div class="flex justify-center items-center my-4">
                    <div>
                        <i class="fa-solid fa-exclamation-circle"></i>
                    </div>
                    &nbsp;Lỗi khi lấy dữ liệu ...
                </div>
            `);
            });
        }

        function fetchRequestWithdrawal(page = 1) {
            instance.post("{{ route('admin.user.requestWithdrawal') }}", {
                page: page,
                user_id: '{{ $user->id }}'
            }).then(response => {
                $('#renderRequestWithdrawal').html(response.data);
                $('tfoot').removeClass('hidden');
            }).catch(error => {
                $('#renderRequestWithdrawal').html(`
                <div class="flex justify-center items-center my-4">
                    <div>
                        <i class="fa-solid fa-exclamation-circle"></i>
                    </div>
                    &nbsp;Lỗi khi lấy dữ liệu ...
                </div>
            `);
            });
        }

        function rewardOrPenalty() {
            var transaction = 'rewardOrPenalty';
            var type = $("input[name='rewardOrPenalty']:checked").val();
            var rewardOrPenaltyAmount = $('#rewardOrPenaltyAmount').val();

            var value = rewardOrPenaltyAmount;
            if (value <= 0) {
                Toastify({
                    text: "Số tiền thanh toán không được nhỏ hơn hoặc bằng 0",
                    duration: 5000,
                    gravity: "top",
                    position: 'center',
                    backgroundColor: "#ff4444",
                }).showToast();
                $('#rewardOrPenaltyAmount').val('');
                return;
            }

            instance.post("{{ route('admin.user.transactionHistoryStore') }}", {
                type: type,
                transaction: transaction,
                rewardOrPenaltyAmount: rewardOrPenaltyAmount,
                user_id: '{{ $user->id }}'

            }).then(response => {
                if (response.data.status == 'error') {
                    Toastify({
                        text: response.data.message,
                        duration: 5000,
                        gravity: "top",
                        position: 'center',
                        backgroundColor: "#ff4444",
                    }).showToast();
                    return;
                }
                $('#rewardOrPenaltyAmount').val('')
                fetchTransactionHistory()
                fetchRequestWithdrawal()
                HSOverlay.close('#rewardOrPenalty');
                Toastify({
                    text: "Thành công",
                    duration: 5000,
                    gravity: "top",
                    position: 'center',
                    backgroundColor: "#00c853",
                }).showToast();
            }).catch(error => {
                console.log(error);
            });
        }

        function payToAgency() {
            var value = $('#payToAgencyMoney').val().replace(/,/g, '');
            if (value <= 0) {
                Toastify({
                    text: "Số tiền thanh toán không được nhỏ hơn hoặc bằng 0",
                    duration: 5000,
                    gravity: "top",
                    position: 'center',
                    backgroundColor: "#ff4444",
                }).showToast();
                $('#payToAgencyMoney').val('');
                $('#payToAgencyFile').val('')
                return;
            }
            var userRevenue = $('#userRevenueMoneyWon').val()
            if (value > userRevenue) {
                Toastify({
                    text: "Số tiền thanh toán không được lớn hơn số tiền còn lại",
                    duration: 5000,
                    gravity: "top",
                    position: 'center',
                    backgroundColor: "#ff4444",
                }).showToast();
                $('#payToAgencyMoney').val('');
                $('#payToAgencyFile').val('')
                return;
            }
            var transaction = 'payToAgency';
            var payToAgencyAmount = $('#payToAgencyMoney').val();
            var file = $('#payToAgencyFile')[0].files[0];
            var formData = new FormData();
            formData.append('payToAgencyAmount', payToAgencyAmount);
            formData.append('file', file);
            formData.append('transaction', transaction);
            formData.append('user_id', '{{ $user->id }}');
            instance.post("{{ route('admin.user.transactionHistoryStore') }}", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    if (response.data.status == 'error') {
                        Toastify({
                            text: response.data.message,
                            duration: 5000,
                            gravity: "top",
                            position: 'center',
                            backgroundColor: "#ff4444",
                        }).showToast();
                        return;
                    }
                    fetchTransactionHistory()
                    fetchRequestWithdrawal()
                    $('#payToAgencyMoney').val('')
                    $('#payToAgencyFile').val('')
                    HSOverlay.close('#payToAgency');
                    Toastify({
                        text: "Thành công",
                        duration: 5000,
                        gravity: "top",
                        position: 'center',
                        backgroundColor: "#00c853",
                    }).showToast();
                }).catch(error => {
                    console.log(error);
                });
        }

        function RequestWithdrawal(id) {
            Swal.fire({
                title: 'Bạn muốn xác nhận yêu cầu rút tiền này?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if(result.isConfirmed) {
                    let formData = new FormData();
                    formData.append('id', id);
                    formData.append('_token', '{{ csrf_token() }}'); // CSRF token bảo vệ
                    instance.post("{{ route('admin.user.confirmRequestWithdrawal') }}", formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then(response => {
                            if (response.data.status == 'error') {
                                Toastify({
                                    text: response.data.message,
                                    duration: 5000,
                                    gravity: "top",
                                    position: 'center',
                                    backgroundColor: "#ff4444",
                                }).showToast();
                                return;
                            }
                            fetchTransactionHistory()
                            fetchRequestWithdrawal()
                            Toastify({
                                text: "Thành công",
                                duration: 5000,
                                gravity: "top",
                                position: 'center',
                                backgroundColor: "#00c853",
                            }).showToast();
                            setTimeout(() => {
                                $('#hs-toast-soft-color-blue-label').parent().remove();
                            }, 2000);
                        }).catch(error => {
                            console.log(error);
                        });
                }
            })

        }

        function CancelRequestWithdrawal(id) {
            Swal.fire({
                title: 'Bạn muốn từ chối yêu cầu rút tiền này?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if(result.isConfirmed) {
                    let formData = new FormData();
                    formData.append('id', id);
                    formData.append('_token', '{{ csrf_token() }}'); // CSRF token bảo vệ
                    instance.post("{{ route('admin.user.cancelRequestWithdrawal') }}", formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then(response => {
                            if (response.data.status == 'error') {
                                Toastify({
                                    text: response.data.message,
                                    duration: 5000,
                                    gravity: "top",
                                    position: 'center',
                                    backgroundColor: "#ff4444",
                                }).showToast();
                                return;
                            }
                            fetchTransactionHistory()
                            fetchRequestWithdrawal()
                            Toastify({
                                text: "Từ chối yêu cầu rút tiền thành công",
                                duration: 5000,
                                gravity: "top",
                                position: 'center',
                                backgroundColor: "#00c853",
                            }).showToast();
                            setTimeout(() => {
                                $('#hs-toast-soft-color-blue-label').parent().remove();
                            }, 2000);
                        }).catch(error => {
                            console.log(error);
                        });
                }
            })
        }
    </script>
@endpush
