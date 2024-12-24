<div class=" overflow-x-auto rounded-lg">
    <div class="min-w-full inline-block align-middle rounded-lg">
        <div class="overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 ">
                <thead class="bg-mainColor">
                    <tr>
                        <th scope="col" class="px-3 py-3 text-start text-xs font-medium text-white uppercase">
                            #
                        </th>
                        <th scope="col" class="px-3 py-3 text-start text-xs font-medium text-white uppercase">
                            Thời gian
                        </th>
                        <th scope="col"
                            class="hidden md:table-cell px-3 py-3 text-start text-xs font-medium text-white uppercase">
                            Số tiền rút
                        </th>
                        <th scope="col"
                            class="hidden md:table-cell px-3 py-3 text-start text-xs font-medium text-white uppercase">
                            Ghi chú
                        </th>
                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-white uppercase">
                            Hành động
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($list_request_withdrawals as $key => $request_withdrawals)
                        <tr>
                            <td class="px-3 py-4 text-start">{{ $key + $pagesize * ($page - 1) + 1 }}</td>
                            <td class="px-3 py-4 text-start">{{ $request_withdrawals->created_at }}</td>
                            <td class="px-3 py-4 text-start text-red-500 font-semibold ">{{formatCurrency2($request_withdrawals->amount)}} VNĐ</td>
                            <td class="px-3 py-4 text-start">{{ $request_withdrawals->note ?? '---' }}</td>
                            <td class="px-3 py-4 text-center">
                                <button type="button" onclick="CancelRequestWithdrawal({{ $request_withdrawals->id}})"
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                                Từ chối
                            </button>
                            <button type="button" onclick="RequestWithdrawal({{ $request_withdrawals->id}})"
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                Xác nhận
                            </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                Không có dữ liệu
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@if ($totalRecord > $pagesize)
    <div class="px-6 py-4 border-t border-gray-200 text-center">
        <nav aria-label="Page navigation" id="pagination_list">
            {{ App\Helpers\PaggingHelper2::show([
                'page' => $page,
                'pagesize' => $pagesize,
                'totalRecord' => $totalRecord,
                'pageMax' => $pageMax,
                'disabledPage' => [],
            ]) }}
        </nav>
    </div>
@endif
<script>
     $(document).ready(function() {
            $('.modalRequestWithdrawal').click( function(){
                $('#RequestWithdrawal').removeClass('hidden'); // Show the modal
                $('#RequestWithdrawal').addClass('flex'); 
            })
        });
</script>