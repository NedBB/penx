<?php

use Carbon\Carbon;

if(! function_exists('icarbon')){
    function icarbon($datetime){
        return Carbon::parse($datetime);
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