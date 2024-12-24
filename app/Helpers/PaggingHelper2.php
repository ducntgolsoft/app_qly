<?php

namespace App\Helpers;

class PaggingHelper2
{
    public static function show($page = array(), $showLabel = 1, $php_call = 0)
    {
        $disabledButton = $page['disabledPage'] ?? [];
        $strpage = '';
        if (sizeof($page) != 0) {
            $strpage .= self::_showPage($page['page'], $page['pageMax'], $page['totalRecord'], $page['location'] ?? 'center', $disabledButton);
        }
        if ($php_call == 0) {
            echo $strpage;
        } else {
            return $strpage;
        }
    }
    private static function _showPage($page, $pageMax, $totalRecord, $location, $disabledButton)
    {
        if ($totalRecord == 0) return '';

        $page1 = ($page <= 2) ? '' : $page - 2;
        $page2 = ($page <= 1) ? '' : $page - 1;
        $page4 = ($pageMax <= $page) ? '' : $page + 1;
        $page5 = ($pageMax <= $page + 1) ? '' : $page + 2;

        // Helper function to determine if a page should be disabled
        function isDisabled($page, $disabledButton)
        {
            return in_array($page, $disabledButton) ? 'disabled' : '';
        }

        $paging = '<nav class="flex justify-' . $location . ' items-center -space-x-px mr-2">';

        // First page button
        $paging .= '
        <button page="1" type="button" ' . isDisabled(1, $disabledButton) . ' class="min-h-[38px] min-w-[38px] py-2 px-2.5 flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-lg last:rounded-e-lg border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:border-neutral-700 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
            <i class="fas fa-angle-double-left text-xs"></i>
        </button>
    ';

        // Previous page button
        $paging .= '
        <button page="' . $page2 . '" type="button" ' . isDisabled($page2, $disabledButton) . ' class="min-h-[38px] min-w-[38px] py-2 px-2.5 flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-lg last:rounded-e-lg border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:border-neutral-700 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
            <i class="fas fa-chevron-left text-xs"></i>
        </button>
    ';

        // Ellipsis for skipping pages
        if ($page1 != '' && $page1 > 2 && $pageMax > 5) {
            $paging .= '
            <button page="1" type="button" ' . isDisabled(1, $disabledButton) . ' class="min-h-[38px] min-w-[38px] py-2 px-2.5 flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-lg last:rounded-e-lg border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:border-neutral-700 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                1
            </button>
        ';
            $paging .= '
            <button disabled class="min-h-[38px] min-w-[38px] py-2 px-2.5 flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-lg last:rounded-e-lg border border-gray-200 text-gray-800 dark:border-neutral-700 dark:text-white">
                <i class="fas fa-ellipsis-h"></i>
            </button>
        ';
        }

        // Page buttons
        if ($page < 5) {
            $temp = $pageMax < 5 ? $pageMax : 5;
            for ($i = 1; $i <= $temp; $i++) {
                $paging .= '
                <button page="' . $i . '" type="button" ' . isDisabled($i, $disabledButton) . ' class="min-h-[38px] min-w-[38px] py-2 px-2.5 flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-lg last:rounded-e-lg border border-gray-200 ' . ($page == $i ? 'bg-blue-500 text-white' : 'text-gray-800 hover:bg-gray-100') . ' focus:outline-none focus:bg-gray-100 dark:border-neutral-700 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                    ' . $i . '
                </button>
            ';
            }
        } else {
            if ($page + 3 < $pageMax) {
                if ($page1 != '') {
                    $paging .= '
                    <button page="' . $page1 . '" type="button" ' . isDisabled($page1, $disabledButton) . ' class="min-h-[38px] min-w-[38px] py-2 px-2.5 flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-lg last:rounded-e-lg border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:border-neutral-700 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                        ' . $page1 . '
                    </button>
                ';
                }
                if ($page2 != '') {
                    $paging .= '
                    <button page="' . $page2 . '" type="button" ' . isDisabled($page2, $disabledButton) . ' class="min-h-[38px] min-w-[38px] py-2 px-2.5 flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-lg last:rounded-e-lg border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:border-neutral-700 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                        ' . $page2 . '
                    </button>
                ';
                }
                $paging .= '
                <button type="button" class="min-h-[38px] min-w-[38px] py-2 px-2.5 flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-lg last:rounded-e-lg border border-gray-200 bg-blue-500 text-white focus:outline-none focus:bg-gray-100 dark:border-neutral-700 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                    ' . $page . '
                </button>
            ';
                if ($page4 != '') {
                    $paging .= '
                    <button page="' . $page4 . '" type="button" ' . isDisabled($page4, $disabledButton) . ' class="min-h-[38px] min-w-[38px] py-2 px-2.5 flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-lg last:rounded-e-lg border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:border-neutral-700 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                        ' . $page4 . '
                    </button>
                ';
                }
                if ($page5 != '') {
                    $paging .= '
                    <button page="' . $page5 . '" type="button" ' . isDisabled($page5, $disabledButton) . ' class="min-h-[38px] min-w-[38px] py-2 px-2.5 flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-lg last:rounded-e-lg border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:border-neutral-700 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                        ' . $page5 . '
                    </button>
                ';
                }
            } else {
                for ($i = $pageMax - 4; $i <= $pageMax; $i++) {
                    $paging .= '
                    <button page="' . $i . '" type="button" ' . isDisabled($i, $disabledButton) . ' class="min-h-[38px] min-w-[38px] py-2 px-2.5 flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-lg last:rounded-e-lg border border-gray-200 ' . ($page == $i ? 'bg-blue-500 text-white' : 'text-gray-800 hover:bg-gray-100') . ' focus:outline-none focus:bg-gray-100 dark:border-neutral-700 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                        ' . $i . '
                    </button>
                ';
                }
            }
        }

        // Ellipsis for skipping pages at the end
        if (($page5 != '' && $pageMax > $page5 && $pageMax > 5 && (!($pageMax == ($page + 3))) || ($pageMax == 6 && $page < 5)) || ($page == 4 && $pageMax == 7)) {
            $paging .= '
            <button disabled class="min-h-[38px] min-w-[38px] py-2 px-2.5 flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-lg last:rounded-e-lg border border-gray-200 text-gray-800 dark:border-neutral-700 dark:text-white">
                <i class="fas fa-ellipsis-h"></i>
            </button>
        ';
            $paging .= '
            <button page="' . $pageMax . '" type="button" ' . isDisabled($pageMax, $disabledButton) . ' class="min-h-[38px] min-w-[38px] py-2 px-2.5 flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-lg last:rounded-e-lg border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:border-neutral-700 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                ' . $pageMax . '
            </button>
        ';
        }

        // Next page button
        $paging .= '
        <button page="' . $page4 . '" type="button" ' . isDisabled($page4, $disabledButton) . ' class="min-h-[38px] min-w-[38px] py-2 px-2.5 flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-lg last:rounded-e-lg border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:border-neutral-700 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
            <i class="fas fa-chevron-right text-xs"></i>
        </button>
    ';

        // Last page button
        $paging .= '
        <button page="' . $pageMax . '" type="button" ' . isDisabled($pageMax, $disabledButton) . ' class="min-h-[38px] min-w-[38px] py-2 px-2.5 flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-lg last:rounded-e-lg border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:border-neutral-700 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
            <i class="fas fa-angle-double-right text-xs"></i>
        </button>
    ';

        $paging .= '</nav>';
        return $paging;
    }
}

// {{ App\Helpers\PaggingHelper2::show([
//     'page' => $page,
//     'pagesize' => $pagesize,
//     'totalRecord' => $totalRecord,
//     'pageMax' => $pageMax,
//     'location' => 'center'
// ]) }}