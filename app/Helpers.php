<?php

use App\Events\SendNotificationUser;
use App\Models\ExchangeRate;
use App\Models\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Pusher\Pusher;

if (!function_exists('isMobileDevice')) {
    function isMobileDevice()
    {
        $agent = new Agent();
        return $agent->isMobile();
    }
}
function formatPrice($price)
{
    return number_format((float) $price, 0, ',', ',');
}
function formatDate($date)
{
    return date('d-m-Y', strtotime($date));
}
function formatDateHIS($date)
{
    return date('d-m-Y H:i:s', strtotime($date));
}

function escapeRegExp($string)
{
    return preg_replace('/[.*+?^${}()|[\]\\]/', '\\\\$0', $string);
}

function convertToSlug($text)
{
    $text = trim($text);
    $text = strtolower($text); // Đưa tất cả các ký tự hoa về thường

    $vietnameseSpecialChars = array(
        'à',
        'á',
        'ạ',
        'ả',
        'ã',
        'ă',
        'ằ',
        'ắ',
        'ẵ',
        'ặ',
        'ẳ',
        'â',
        'ầ',
        'ấ',
        'ậ',
        'ẩ',
        'đ',
        'è',
        'é',
        'ẹ',
        'ẻ',
        'ẽ',
        'ê',
        'ề',
        'ế',
        'ệ',
        'ể',
        'ễ',
        'ì',
        'í',
        'ị',
        'ỉ',
        'ĩ',
        'ò',
        'ó',
        'ọ',
        'ỏ',
        'õ',
        'ô',
        'ồ',
        'ố',
        'ộ',
        'ổ',
        'ỗ',
        'ơ',
        'ờ',
        'ớ',
        'ợ',
        'ở',
        'ù',
        'ú',
        'ụ',
        'ủ',
        'ũ',
        'ư',
        'ừ',
        'ứ',
        'ự',
        'ử',
        'ữ',
        'ỳ',
        'ý',
        'ỵ',
        'ỷ',
        'ỹ',
        'ñ',
        'ç',
        ' ',
        '!',
        '@',
        '#',
        '$',
        '%',
        '^',
        '&',
        '*',
        '(',
        ')',
        '_',
        '+',
        '=',
        '-',
        '{',
        '}',
        '[',
        ']',
        '|',
        '\\',
        ':',
        ';',
        '"',
        '\'',
        '<',
        '>',
        ',',
        '.',
        '?',
        '/',
        'À',
        'Á',
        'Ạ',
        'Ả',
        'Ã',
        'Ă',
        'Ằ',
        'Ắ',
        'Ẵ',
        'Ặ',
        'Ẳ',
        'Â',
        'Ầ',
        'Ấ',
        'Ậ',
        'Ẩ',
        'Đ',
        'È',
        'É',
        'Ẹ',
        'Ẻ',
        'Ẽ',
        'Ê',
        'Ề',
        'Ế',
        'Ệ',
        'Ể',
        'Ễ',
        'Ì',
        'Í',
        'Ị',
        'Ỉ',
        'Ĩ',
        'Ò',
        'Ó',
        'Ọ',
        'Ỏ',
        'Õ',
        'Ô',
        'Ồ',
        'Ố',
        'Ộ',
        'Ổ',
        'Ỗ',
        'Ơ',
        'Ờ',
        'Ớ',
        'Ợ',
        'Ở',
        'Ù',
        'Ú',
        'Ụ',
        'Ủ',
        'Ũ',
        'Ư',
        'Ừ',
        'Ứ',
        'Ự',
        'Ử',
        'Ữ',
        'Ỳ',
        'Ý',
        'Ỵ',
        'Ỷ',
        'Ỹ',
    );

    $replacementChars = array(
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'd',
        'e',
        'e',
        'e',
        'e',
        'e',
        'e',
        'e',
        'e',
        'e',
        'e',
        'e',
        'i',
        'i',
        'i',
        'i',
        'i',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'u',
        'u',
        'u',
        'u',
        'u',
        'u',
        'u',
        'u',
        'u',
        'u',
        'u',
        'y',
        'y',
        'y',
        'y',
        'y',
        'n',
        'c',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        '-',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'd',
        'e',
        'e',
        'e',
        'e',
        'e',
        'e',
        'e',
        'e',
        'e',
        'e',
        'e',
        'i',
        'i',
        'i',
        'i',
        'i',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'u',
        'u',
        'u',
        'u',
        'u',
        'u',
        'u',
        'u',
        'u',
        'u',
        'u',
        'y',
        'y',
        'y',
        'y',
        'y',
    );

    // Sử dụng str_replace thay vì preg_replace
    $text = str_replace($vietnameseSpecialChars, $replacementChars, $text);

    // Thay thế các ký tự không hợp lệ bằng dấu gạch ngang
    $text = preg_replace('/[^a-z0-9-]+/', '-', $text);
    return $text;
}


function formatCurrency($amount, $currency = true)
{
    if (!$currency) {
        return number_format((float) $amount, 0, '', '.');
    }
    return number_format((float) $amount, 0, '', '.') . ' VNĐ';
}

function formatCurrency2($amount)
{
    return number_format($amount, 0, '', ',');
}

function formatCurrency3($amount, $format)
{
    return number_format($amount, 0, '', ',') . ' ' . $format;
}

if (!function_exists('truncateString')) {
    function truncateString($string, $limit = 50, $end = '...')
    {
        return Str::limit($string, $limit, $end);
    }
}

if (!function_exists('SendNotificationUser')) {
    function SendNotificationUser($user, $message = '', $data = [])
    {
        Notification::create([
            'title' => $data['title'] ?? 'Thông báo',
            'content' => $message,
            'type' => $data['type'] ?? 1,
            'url' => $data['url'] ?? '',
            'data' => json_encode($data),
            'user_id' => $user->id,
            'is_read' => 0,
            'sent_at' => now(),
        ]);
        event(new SendNotificationUser([
            'count' => $user->notificationUnRead(),
            'user_id' => $user->id,
            'message' => $message,
            'money' => $data['money'] ?? 0,
        ]));
    }
}

if (!function_exists('getCurrencyExchangeApi')) {
    function getCurrencyExchangeApi($exchange)
    {
        $response = Http::get('https://v6.exchangerate-api.com/v6/' . env('EXCHANGERATE_KEY') . '/latest/' . $exchange);
        $result = $response->json();
        if ($result['conversion_rates']['VND'] > 0) {
            $file = fopen(config_path('currency.php'), 'w');
            fwrite($file, '<?php return ' . var_export([
                'amount' => $result['conversion_rates']['VND'],
                'time' => formatDateTime(time()),
            ], true) . ';');
            fclose($file);
        }
        return $result['conversion_rates']['VND'] ?? 0;
    }
}

if (!function_exists('getCurrencyExchange')) {
    function getCurrencyExchange($userCurrency = 'KRW')
    {
        $currency = include config_path('currency.php');
        return 1;
    }
}

// format money won
if (!function_exists('formatMoneyWon')) {
    function formatMoneyWon($amount)
    {
        return formatCurrency2($amount);
        // return number_format($amount, 2, '.', ',');
    }
}

if (!function_exists('formatDateTime')) {
    function formatDateTime($datetime, $format = 'd/m/Y H:i:s')
    {
        return date($format, strtotime($datetime));
    }
}

if (!function_exists('getSslPage')) {
    function getSslPage($url)
    {
        $ch = curl_init();
        $headr = array();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($ch, CURLOPT_URL, $url); // get the url contents
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'spider');
        $data = curl_exec($ch); // execute curl request
        curl_close($ch);
        $xml = simplexml_load_string($data);
        return json_encode($xml);
    }
}

if (!function_exists('show_rate_to_vnd')) {
    function show_rate_to_vnd($CurrencyCode = ['KRW', 'JPY'])
    {
        $host = "https://portal.vietcombank.com.vn/Usercontrols/TVPortal.TyGia/pXML.aspx?b=8";
        $json_string = getSslPage($host);
        $result_array = json_decode($json_string, TRUE);
        foreach ($result_array['Exrate'] as $country_curency) {
            $list_curency[$country_curency['@attributes']['CurrencyCode']] = $country_curency['@attributes']['Transfer'];
        }
        $arrCurrency = [];
        foreach ($CurrencyCode as $key => $value) {
            $amount = $list_curency[$value];
            $arrCurrency[$value] = $amount;
        }
        $file = fopen(config_path('currency.php'), 'w');
        fwrite($file, '<?php return ' . var_export($arrCurrency, true) . ';');
        fclose($file);
        return 0;
    }
}
