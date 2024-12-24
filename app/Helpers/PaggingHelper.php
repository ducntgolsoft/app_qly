<?php

/**
 *-------------------------------------------------------------------------*
 * Souei
 * Helpers pagging
 *
 * 処理概要/process overview  :
 * 作成日/create date         :   2016/11/15
 * 作成者/creater             :   vuongvt – vuongvt@ans-asia.com
 *
 * @package                  :   MASTER
 * @copyright                :   Copyright (c) ANS-ASIA
 * @version                  :   1.0.0
 *-------------------------------------------------------------------------*
 * DESCRIPTION
 *
 *
 *
 *
 */

namespace App\Helpers;

class PaggingHelper
{
    public static function show($page = array(), $showLabel = 1, $php_call = 0)
    {
        $strpage = '';
        $disabledButton = $page['disabledPage'] ?? [];
        if (sizeof($page) != 0) {
            $start = min(($page['page'] - 1) * $page['pagesize'] + 1, $page['totalRecord']);
            $end = min(($page['page'] - 1) * $page['pagesize'] + 40, $page['totalRecord']);
            $label = $showLabel == 1 ? self::_displayCount($start, $end, $page['totalRecord']) : '';
            $strpage = '<label class="panel-title inline-block" style="display: none">' . $label . '</label>';
            $strpage .= self::_showPage($page['page'], $page['pageMax'], $page['totalRecord'], $disabledButton);
        }
        if ($php_call == 0) {
            echo $strpage;
        } else {
            return $strpage;
        }
    }

    private static function _showPage($page, $pageMax, $totalRecord, $disabledButton)
    {
        if ($totalRecord == 0) {
            return '';
        }

        // Helper function to determine if a page is disabled
        function isDisabled($page, $disabledButton)
        {
            return in_array($page, $disabledButton) ? 'pagging-disable' : '';
        }

        $disabledfirst = ($page <= 1) ? 'pagging-disable' : isDisabled(1, $disabledButton);
        $pagePrevious = 0;
        if ($page > 1) {
            $pagePrevious = $page - 1;
        }
        $page1 = ($page <= 2) ? '' : $page - 2;
        $page2 = ($page <= 1) ? '' : $page - 1;
        $page4 = ($pageMax <= $page) ? '' : $page + 1;
        $page5 = ($pageMax <= $page + 1) ? '' : $page + 2;
        $disabledlast = ($page >= $pageMax) ? 'pagging-disable' : isDisabled($pageMax, $disabledButton);

        $paging = '<ul class="inline-flex -space-x-px text-sm">';
        $paging .= '<li class="page-item cursor-pointer ' . $disabledfirst . '">';
        $paging .= '<a style="width:32px; height:32px;" class="flex items-center justify-center p-2 mr-1 rounded-full ms-0 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link ' . $disabledfirst . '" page="1"><i class="fa fa-angle-double-left"></i></a>';
        $paging .= '</li>';

        $paging .= '<li class="page-item cursor-pointer ' . isDisabled($page2, $disabledButton) . '">';
        $paging .= '<a style="width:32px; height:32px;" class="flex items-center justify-center p-2 mr-1 rounded-full leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link ' . isDisabled($page2, $disabledButton) . '" page="' . $page2 . '"><i class="fa fa-angle-left"></i></a>';
        $paging .= '</li>';

        if ($page1 != '' && $page1 > 2 && $pageMax > 5) {
            $paging .= '<li class="page-item cursor-pointer step_1 ' . isDisabled(1, $disabledButton) . '">';
            $paging .= '<a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link ' . isDisabled(1, $disabledButton) . '" page="1">1</a>';
            $paging .= '</li>';

            $paging .= '<li class="page-item cursor-pointer pagging-disable disabled">';
            $paging .= '<a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link" style="padding-top: 12px;"><i class="fa fa-ellipsis-h"></i></a>';
            $paging .= '</li>';
        }

        if ($page < 5) {
            $temp = $pageMax < 5 ? $pageMax : 5;
            for ($i = 1; $i <= $temp; $i++) {
                $paging .= '<li class="page-item cursor-pointer step_2 ' . isDisabled($i, $disabledButton) . '">';
                $paging .= '<a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link ' . isDisabled($i, $disabledButton) . '" page="' . $i . '">' . $i . '</a>';
                $paging .= '</li>';
            }
        } else {
            if ($page + 3 < $pageMax) {
                if ($page1 != '') {
                    $paging .= '<li class="page-item cursor-pointer step_3 ' . isDisabled($page1, $disabledButton) . '">';
                    $paging .= '<a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link ' . isDisabled($page1, $disabledButton) . '" page="' . $page1 . '">' . $page1 . '</a>';
                    $paging .= '</li>';
                }
                if ($page2 != '') {
                    $paging .= '<li class="page-item cursor-pointer step_4 ' . isDisabled($page2, $disabledButton) . '">';
                    $paging .= '<a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link ' . isDisabled($page2, $disabledButton) . '" page="' . $page2 . '">' . $page2 . '</a>';
                    $paging .= '</li>';
                }
                $paging .= '<li class="page-item cursor-pointer active">';
                $paging .= '<a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 ms-0 leading-tight text-white bg-blue-600 border border-e-0 border-gray-300 page-link" page="' . $page . '">' . $page . '</a>';
                $paging .= '</li>';
                if ($page4 != '') {
                    $paging .= '<li class="page-item cursor-pointer step_5 ' . isDisabled($page4, $disabledButton) . '">';
                    $paging .= '<a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link ' . isDisabled($page4, $disabledButton) . '" page="' . $page4 . '">' . $page4 . '</a>';
                    $paging .= '</li>';
                }
                if ($page5 != '') {
                    $paging .= '<li class="page-item cursor-pointer step_6 ' . isDisabled($page5, $disabledButton) . '">';
                    $paging .= '<a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link ' . isDisabled($page5, $disabledButton) . '" page="' . $page5 . '">' . $page5 . '</a>';
                    $paging .= '</li>';
                }
            } else {
                for ($i = $pageMax - 4; $i <= $pageMax; $i++) {
                    $paging .= '<li class="page-item cursor-pointer step_7 ' . isDisabled($i, $disabledButton) . '">';
                    $paging .= '<a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link ' . isDisabled($i, $disabledButton) . '" page="' . $i . '">' . $i . '</a>';
                    $paging .= '</li>';
                }
            }
        }

        if (($page5 != '' && $pageMax > $page5 && $pageMax > 5 && (!($pageMax == ($page + 3))) || ($pageMax == 6 && $page < 5)) || ($page == 4 && $pageMax == 7)) {
            $paging .= '<li class="page-item cursor-pointer pagging-disable disabled">';
            $paging .= '<a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link" style="padding-top: 12px;"><i class="fa fa-ellipsis-h"></i></a>';
            $paging .= '</li>';

            $paging .= '<li class="page-item cursor-pointer step_8 ' . isDisabled($pageMax, $disabledButton) . '">';
            $paging .= '<a class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link ' . isDisabled($pageMax, $disabledButton) . '" page="' . $pageMax . '">' . $pageMax . '</a>';
            $paging .= '</li>';
        }

        $paging .= '<li class="page-item cursor-pointer ' . $disabledlast . '">';
        $paging .= '<a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link ' . $disabledlast . '" page="' . $page4 . '"><i class="fa fa-angle-right"></i></a>';
        $paging .= '</li>';

        $paging .= '<li class="page-item cursor-pointer ' . $disabledlast . '">';
        $paging .= '<a style="width:32px; height:32px;" page="' . $pageMax . '" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link ' . $disabledlast . '"><i class="fa fa-angle-double-right"></i></a>';
        $paging .= '</li>';
        $paging .= '</ul>';

        return $paging;
    }


    public static function showText($page = array(), $showLabel = 1, $php_call = 0, $mode = 0)
    {
        $strpage = '';
        if (sizeof($page) != 0) {
            $start = min(($page['page'] - 1) * $page['pagesize'] + 1, $page['totalRecord']);
            $end = min(($page['page'] - 1) * $page['pagesize'] + 40, $page['totalRecord']);
            if ($mode == 0) {
                $label = $showLabel == 1 ? self::_displayCount($start, $end, $page['totalRecord'], $mode) : '';
            } else {
                $label = $showLabel == 1 ? self::_displayCount($page['page'], $page['pageMax'], $page['totalRecord'], $mode) : '';
            }
            $strpage = '<label class="panel-title inline-block">' . $label . '</label>';
        }
        if ($php_call == 0) {
            echo $strpage;
        } else {
            return $strpage;
        }
    }

    private static function _showPage2($page, $pageMax, $totalRecord)
    {
        if ($totalRecord == 0) {
            return '';
        }
        //add new
        $disabledfirst = ($page <= 1) ? 'pagging-disable' : '';
        $pagePrevious = 0;
        if ($page > 1) {
            $pagePrevious = $page - 1;
        }
        $page1 = ($page <= 2) ? '' : $page - 2;
        $page2 = ($page <= 1) ? '' : $page - 1;
        $page4 = ($pageMax <= $page) ? '' : $page + 1;
        $page5 = ($pageMax <= $page + 1) ? '' : $page + 2;
        $disabledlast = ($page >= $pageMax) ? 'pagging-disable' : '';

        $paging = '<ul class="inline-flex -space-x-px text-sm">';
        $paging .= '    <li class="page-item cursor-pointer ' . $disabledfirst . '"><a style="width:32px; height:32px;" class="flex items-center justify-center p-2 mr-1 rounded-full ms-0 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link ' . $disabledfirst . '" page="1"><i class="fa fa-angle-double-left"></i></a></li>'; // DuyTP 2017/02/16
        $paging .= '    <li class="page-item cursor-pointer  ' . $disabledfirst . '"><a style="width:32px; height:32px;" class="flex items-center justify-center p-2 mr-1 rounded-full leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link ' . $disabledfirst . '" page="' . $page2 . '"><i class="fa fa-angle-left"></i></a></li>'; // QuyND 2017/12/07
        if ($page1 != '' && $page1 > 2 && $pageMax > 5) {
            $paging .= '    <li class="page-item cursor-pointer step_1"><a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link  page-link page-link" page="1">1</a></li>';
            $paging .= '    <li class="page-item cursor-pointer pagging-disable  disabled"><a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link" style="padding-top: 12px;"><i class="fa fa-ellipsis-h"></i></a></li>';
        }
        if ($page < 5) {
            if ($pageMax < 5) {
                $temp = $pageMax;
            } else {
                $temp = 5;
            }
            for ($i = 1; $i <= $temp; $i++) {
                if ($page != $i) {
                    $paging .= '<li class="page-item cursor-pointer step_2"><a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link" page="' . $i . '">' . $i . '</a></li>';
                } else {
                    $paging .= '<li class="page-item cursor-pointer active"><a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-white bg-blue-600 border border-gray-300  page-link" page="' . $i . '">' . $i . '</a></li>';
                }
            }
        } else {
            if ($page + 3 < $pageMax) {
                if ($page1 != '') {
                    $paging .= '    <li class="page-item cursor-pointer step_3"><a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link  page-link page-link page-link" page="' . $page1 . '">' . $page1 . '</a></li>';
                }
                if ($page2 != '') {
                    $paging .= '    <li class="page-item cursor-pointer step_4"><a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link  page-link page-link page-link" page="' . $page2 . '">' . $page2 . '</a></li>';
                }

                $paging .= '    <li class="page-item cursor-pointer active"><a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 ms-0 leading-tight text-white bg-blue-600 border border-e-0 border-gray-300  page-link" page="' . $page . '">' . $page . '</a></li>';
                if ($page4 != '') {
                    $paging .= '    <li  class="page-item cursor-pointer  step_5"><a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link  page-link page-link page-link" page="' . $page4 . '">' . $page4 . '</a></li>';
                }
                if ($page5 != '') {
                    $paging .= '    <li class="page-item cursor-pointer  step_6"><a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link  page-link page-link page-link" page="' . $page5 . '">' . $page5 . '</a></li>';
                }
            } else {
                for ($i = $pageMax - 4; $i <= $pageMax; $i++) {
                    if ($page != $i) {
                        $paging .= '<li class="page-item cursor-pointer step_7"><a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link  page-link" page="' . $i . '">' . $i . '</a></li>';
                    } else {
                        $paging .= '<li class="page-item cursor-pointer active"><a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 ms-0 leading-tight text-white bg-blue-600 border border-e-0 border-gray-300  page-link" page="' . $i . '">' . $i . '</a></li>';
                    }
                }
            }
        }

        if (($page5 != '' && $pageMax > $page5 && $pageMax > 5 && (!($pageMax == ($page + 3))) || ($pageMax == 6 && $page < 5)) || ($page == 4 && $pageMax == 7)) {
            $paging .= '    <li class="page-item cursor-pointer pagging-disable disabled"><a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link" style="padding-top: 12px;"><i class="fa fa-ellipsis-h"></i></a></li>';
            $paging .= '    <li class="page-item cursor-pointer  step_8"><a class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link" page="' . $pageMax . '">' . $pageMax . '</a></li>';
        }
        $paging .= '    <li class="page-item cursor-pointer ' . $disabledlast . '"><a style="width:32px; height:32px;" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link ' . $disabledlast . '" page="' . $page4 . '"><i class="fa fa-angle-right"></i></a></li>'; // QuyND 2017/12/07
        $paging .= '    <li class="page-item cursor-pointer ' . $disabledlast . '"><a style="width:32px; height:32px;" page="' . $pageMax . '" class="flex items-center justify-center rounded-full p-2 mr-1 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white page-link ' . $disabledlast . '"><i class="fa fa-angle-double-right"></i></a></li>'; // DuyTP 2017/02/16
        $paging .= '</ul>';
        return $paging;
    }

    private static function _displayCount($start, $end, $totalRecord, $mode = 0)
    {
        $displaycount = '';
        if ($mode == 0) {
            if ($start != 0 && $totalRecord > 0) {
                $displaycount = number_format($totalRecord) . "件の結果から " . number_format($start) . "-" . number_format($end) . "件を表示する";
            } else {
                $displaycount = number_format($totalRecord) . "件 ";
            }
        } else {
            $displaycount = number_format($end) . "ページの結果から ページ" . number_format($start) . "を表示する";
        }
        return $displaycount;
    }
}
