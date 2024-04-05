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

if(! function_exists('sqltime') ){
    function sqltime($time='now'){
        $format = 'H\:i\:s';
        return icarbon($time)->format($format);
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