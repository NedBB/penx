<?php

use Carbon\Carbon;

if(! function_exists('icarbon')){
    function icarbon($datetime){
        return Carbon::parse($datetime);
    }
}

if (!function_exists('toSentenceCase')) {
    function toSentenceCase($text)
    {
        $text = strtolower($text);

        // Use a regular expression to match sentences and capitalize the first letter
        $text = preg_replace_callback('/(^\s*\w|[.!?]\s*\w)/', function ($matches) {
            return strtoupper($matches[0]);
        }, $text);

        return $text;
    }
}

if(! function_exists('sqldatetime') ){
    function sqldatetime($time='now'){
        $format = 'Y\-m\-d H\:i\:s';
        return icarbon($time)->format($format);
    }
}

if( ! function_exists('isValidDate') ){
    function isValidDate($date){

        if( ! $date || (! is_object($date) && is_string($date) && (int)$date == 0) || (is_object($date) && $date->year < 1600)){
            return false;
        }

        return true;
    }
}

if( ! function_exists('date2') ){
    function date2($date){
        $format = 'jS F, Y';
        return custom_format_date($date, $format);
    }
}

if( ! function_exists('date3') ){
    function date3($date){
        $format = 'jS M, y';
        return custom_format_date($date, $format);
    }
}

if( ! function_exists('date4') ){
    function date4($date){
        $format = 'jS M \'y \- g\:i a';
        return custom_format_date($date, $format);
    }
}
if( ! function_exists('date5') ){
    function date5($date){
        $format = 'd\/m\/Y ';
        return custom_format_date($date, $format);
    }
}

if(! function_exists('generate_numbers')) {
    function generate_numbers($len, $removeZero = false) {
        $a='';
        $start = ($removeZero) ? 1 : 0;
        for ($i = 0; $i<$len; $i++) {
            $a .= mt_rand($start,9);
        }
        return $a;
    }
}


if( ! function_exists('custom_format_date') ){
    function custom_format_date( $date = null, $format="jS F, Y \- g\:i\:s a" ){

        if(! isValidDate($date)){
            return 'N/A';
        }

        if( is_object($date) && $date instanceof Carbon ){
            return $date->format($format);
        }

        return icarbon($date)->format($format);
    }
}

if( ! function_exists('date4') ){
    function date4($date)
    {
        $format = 'jS M \'y \/ g \: i a';
        return custom_format_date($date, $format);
    }
}

if(! function_exists('format_num')){
	function format_num($num, $dec_places=2, $dec_symbol='.', $thousand_group=''){
		return number_format((float)$num, $dec_places, $dec_symbol, $thousand_group);
	}
}

if(! function_exists('format_money')){
	function format_money($num){
		$num = ($num > 0) ? $num : 0;
		return format_num($num, 2, '.', ',');
	}
}
if(! function_exists('sqldate') ){
    function sqldate($time='now'){
        $format = 'Y\-m\-d';
        return icarbon($time)->format($format);
    }
};

if(! function_exists('format_money')){
	function format_money($num, $kobo=true){

		//$num = ($num > 0) ? $num : 0;
		$num = (is_numeric($num)) ? $num : 0;

		$dec = ($kobo) ? 2 : 0;
		return format_num($num, $dec, '.', ',');
	}
}

if( ! function_exists('currency') ){
	function currency($code=false){
		return ($code) ? 'NGN' : '';//'₦'
	}
}

if(! function_exists('format_currency')){
	function format_currency($num, $kobo=false, $currency_code=false){
		$cur = currency($currency_code);
		$money = format_money($num, $kobo);
		//tt($money, true);
		return $cur.$money;
	}
}

if(! function_exists('numberToWords')){
    function numberToWords($num) {
        $ones = array(
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen'
        );
            
        $tens = array(
            2 => 'Twenty',
            3 => 'Thirty',
            4 => 'Forty',
            5 => 'Fifty',
            6 => 'Sixty',
            7 => 'Seventy',
            8 => 'Eighty',
            9 => 'Ninety'
        );
    
        $hundreds = array(
            'Hundred',
            'Thousand',
            'Million',
            'Billion',
            'Trillion',
            'Quadrillion'
        );
    
        $num = number_format((float)$num, 2, '.', '');
    list($whole, $fraction) = explode('.', $num);
    
    $result = [];
    
    // Convert whole number part
    if ($whole > 0) {
        $result[] = convertWholeNumber($whole, $ones, $tens);
    } else {
        $result[] = $ones['0'];
    }
    
    // Convert fraction part (cents)
    if ($fraction > 0) {
        $result[] = 'naira and';
        $result[] = convertTwoDigits($fraction, $ones, $tens);
        $result[] = 'kobo';
    }
    
    return implode(' ', $result);
    }
}

if(! function_exists('convertWholeNumber')){
    function convertWholeNumber($num, $ones, $tens) {
        $groups = ['', 'Thousand', 'Million', 'Billion'];
        $result = [];
        $num = str_pad($num, ceil(strlen($num)/3)*3, '0', STR_PAD_LEFT);
        $chunks = str_split($num, 3);
        
        foreach ($chunks as $i => $chunk) {
            if ($chunk != '000') {
                $result[] = convertThreeDigits($chunk, $ones, $tens);
                $result[] = $groups[count($chunks)-1-$i];
            }
        }
        
        return implode(' ', array_filter($result));
}

}

if(! function_exists('convertThreeDigits')){
    function convertThreeDigits($num, $ones, $tens) {
        $words = array();
        if ($num >= 100) {
            $words[] = $ones[floor($num / 100)] . ' Hundred';
            $num %= 100;
        }
        if ($num > 0) {
            $words[] = convertTwoDigits($num, $ones, $tens);
        }
        return implode(' ', $words);
    }
}

if(! function_exists('convertTwoDigits')){
    function convertTwoDigits($num, $ones, $tens) {
        if ($num < 20) {
            return $ones[$num];
        }
        $words = array($tens[floor($num / 10)]);
        if ($num % 10 > 0) {
            $words[] = $ones[$num % 10];
        }
        return implode('-', $words);
    }
}

function helper($num, $ones, $teens, $tens) {
    if ($num < 10) {
        return $ones[$num];
    } elseif ($num < 20) {
        return $teens[$num - 10];
    } elseif ($num < 100) {
        return $tens[floor($num / 10)] . ($num % 10 != 0 ? ' ' . $ones[$num % 10] : '');
    } else {
        return $ones[floor($num / 100)] . ' hundred' . ($num % 100 != 0 ? ' and ' . helper($num % 100, $ones, $teens, $tens) : '');
    }
}


if(! function_exists('convertNumberToWords')){
    function convertNumberToWords($number) {
        $number = (float)str_replace(',', '', $number);
       
        $words = array(
            '0' => 'Zero', '1' => 'One', '2' => 'Two', '3' => 'Three', '4' => 'Four',
            '5' => 'Five', '6' => 'Six', '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
            '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve', '13' => 'Thirteen', '14' => 'Fourteen',
            '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen', '18' => 'Eighteen', '19' => 'Nineteen',
            '20' => 'Twenty', '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty', '60' => 'Sixty',
            '70' => 'Seventy', '80' => 'Eighty', '90' => 'Ninety'
        );
    
        $units = array('', 'Hundred', 'Thousand', 'Million', 'Billion', 'Trillion');
        
        if ($number == 0) {
            return $words[0];
        }
    
        $number = number_format($number, 2, '.', ''); // Format number to 2 decimals
        list($whole, $decimal) = explode('.', $number);
        
        $whole = (int)$whole;
        $decimal = (int)$decimal;
    
        $word = convertWholeNumberToWords($whole, $words, $units);
        $word .= ' Naira, ' . convertWholeNumberToWords($decimal, $words, $units) . ' Kobo';
        
        return $word;
    }
}
if(! function_exists('convertWholeNumberToWords')){

    function convertWholeNumberToWords($number, $words, $units) {
        if ($number == 0) {
            return '';
        }
    
        $result = '';
        $unitIndex = 0;
    
        while ($number > 0) {
            if ($number % 1000 != 0) {
                $result = convertHundreds($number % 1000, $words) . ' ' . $units[$unitIndex] . ' ' . $result;
            }
            $number = (int)($number / 1000);
            $unitIndex++;
        }
    
        return trim($result);
    }
}
if(! function_exists('convertHundreds')){

    function convertHundreds($number, $words) {
        $result = '';
    
    if ($number > 99) {
        $result .= $words[(int)($number / 100)] . ' Hundred ';
        $number = $number % 100;
    }

    if ($number > 20) {
        $result .= $words[(int)($number / 10) * 10] . ' ';
        $number = $number % 10;
    }

    if ($number > 0) {
        $result .= $words[$number] . ' ';
    }

    return $result;
    }
}

if(!function_exists('convertAmountToWord')){
    function convertAmountToWord(string $number)
{
    $number = (float)$number;
    
    // Split integer and decimal parts
    $integerPart = floor($number);
    $decimalPart = round(($number - $integerPart) * 100);

    $words = [
        0 => '', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 
        5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen', 
        14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen', 
        18 => 'Eighteen', 19 => 'Nineteen', 20 => 'Twenty',
        30 => 'Thirty', 40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
    ];

    $digits = ['', 'Thousand', 'Million', 'Billion', 'Trillion'];

    $result = [];
    $i = 0;

    while ($integerPart > 0) {
        $numberPart = $integerPart % 1000;  // Get the last three digits
        if ($numberPart > 0) {
            $result[] = convertThreeDigits($numberPart, $words) . ' ' . $digits[$i];
        }
        $integerPart = floor($integerPart / 1000);
        $i++;
    }

    $naira = implode(' ', array_reverse($result)) . ' Naira';

    // Handle decimal part (Kobo)
    $kobo = '';
    if ($decimalPart > 0) {
        $kobo = ', ' . convertTwoDigits($decimalPart, $words) . ' Kobo';
    }
    //dd(trim($naira . $kobo));
    return trim($naira . $kobo. ' Only');
}
}
if(!function_exists('convertThreeDigits')){
// Helper function to convert three-digit numbers
function convertThreeDigits($num, $words)
{
    $hundred = floor($num / 100);
    $remainder = $num % 100;

    $result = '';
    if ($hundred > 0) {
        $result .= $words[$hundred] . ' Hundred';
        if ($remainder > 0) {
            $result .= ' and ';
        }
    }

    if ($remainder > 0) {
        $result .= convertTwoDigits($remainder, $words);
    }

    return $result;
}
}

if(!function_exists('convertTwoDigits')){


// Helper function to convert numbers less than 100
function convertTwoDigits($num, $words)
{
    if ($num <= 20) {
        return $words[$num];
    } else {
        $tens = floor($num / 10) * 10;
        $units = $num % 10;
        return $words[$tens] . ($units > 0 ? ' ' . $words[$units] : '');
    }
}

}