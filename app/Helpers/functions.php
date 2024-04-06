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