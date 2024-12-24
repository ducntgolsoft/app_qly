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
                            Thưởng
                        </th>
                        <th scope="col"
                            class="hidden md:table-cell px-3 py-3 text-start text-xs font-medium text-white uppercase">
                            Phạt
                        </th>
                        <th scope="col" class="px-3 py-3 text-start text-xs font-medium text-white uppercase">
                            Rút
                        </th>
                        <th scope="col"
                            class="px-3 py-3 text-start text-xs font-medium text-white uppercase">
                            Loại tiền
                        </th>
                        <th scope="col"
                            class="px-3 py-3 text-start text-xs font-medium text-white uppercase">
                            Ghi chú
                        </th>
                        <th scope="col"
                            class="px-3 py-3 hidden md:table-cell text-start text-xs font-medium text-white uppercase">
                            Hình ảnh giao dịch
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($list_history_transaction as $key => $history_transaction)
                        <tr>
                            <td class="px-3 py-4 text-start">{{ $key + $pagesize * ($page - 1) + 1 }}</td>
                            <td class="px-3 py-4 text-start">{{ $history_transaction->created_at }}</td>
                            <td class="px-3 py-4 text-start {{ $history_transaction->amount_reward > 0 ? 'text-green-500 font-semibold' : 'text-gray-400' }} ">
                                @if($history_transaction->amount_reward > 0)
                                    {{ formatCurrency2($history_transaction->amount_reward) }} {{$user->getCurrency()}}
                                @else
                                    ---
                                @endif
                            </td>
                            <td class="px-3 py-4 text-start {{ $history_transaction->amount_punish > 0 ? 'text-red-500 font-semibold' : 'text-gray-400' }} ">
                                @if($history_transaction->amount_punish > 0)
                                    {{ formatCurrency2($history_transaction->amount_punish) }} {{$user->getCurrency()}}
                                @else
                                    ---
                                @endif
                            </td>
                            <td class="px-3 py-4 text-start {{ $history_transaction->withdraw_cash > 0 ? 'text-red-500 font-semibold' : 'text-gray-400' }}">
                                {{-- {{ formatCurrency2($history_transaction->withdraw_cash) ?? '---' }} {{$user->getCurrency()}} --}}
                                @if($history_transaction->withdraw_cash > 0)
                                    {{ formatCurrency2($history_transaction->withdraw_cash) }} {{$user->getCurrency()}}
                                @else
                                    ---
                                @endif
                            </td>
                            <td class="px-3 py-4 text-start">{{ $history_transaction->currency ?? '---' }}</td>
                            <td class="px-3 py-4 text-start">{{ $history_transaction->note ?? '---' }}</td>

                            <td class="px-3 py-4 text-start">
                                @if($history_transaction->file)
                                    <a href="/storage/{{$history_transaction->file}}" data-lightbox="roadtrip" class="flex align-items-center justify-content-center btn btn-sm btn-border-custom">
                                        Xem GD
                                    </a>
                                @else
                                    ---
                                @endif
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
                @if($totalRecord > 0)
                    <tfoot>
                        <tr>
                            <td></td>
                            <td class="px-3 py-4 text-end font-bold">Tổng</td>
                            <td class="px-3 py-4 text-start" id="totalReward">{{ $totalReward }}</td>
                            <td class="px-3 py-4 text-start" id="totalPunish">{{ $totalPunish }}</td>
                            <td class="px-3 py-4 text-start" id="totalWithdrawCash">{{ $totalWithdrawCash }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                @endif
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
    var totalReward = "{{ $totalReward }}";
    var totalPunish = "{{ $totalPunish }}";
    var totalWithdrawCash = "{{ $totalWithdrawCash }}";
    $('#totalReward').addClass(totalReward == '0 {{$user->getCurrency()}}' ? 'text-gray-400' : 'text-green-500 font-bold')
    $('#totalPunish').addClass(totalPunish == '0 {{$user->getCurrency()}}' ? 'text-gray-400' : 'text-red-500 font-bold')
    $('#totalWithdrawCash').addClass(totalWithdrawCash == '0 {{$user->getCurrency()}}' ? 'text-gray-400' : 'text-red-500 font-bold')
    $('.userRevenue').html("{{ $userRevenueFormat }}")
    $('.userRevenueVN').html("{{ $userRevenueVN }}")
    $('#userRevenueMoney').val({{ $userRevenue }})
</script>
