<?php
if (!defined('CALLERID')) {
    // This check helps protect against security problems;
    // your code file can't be executed directly from the web.
    exit(1);
}

class PtNumberCleaner extends NumberCleaner
{
    function clean_number($number){
        switch(strlen($number)){
            case 9:
	            $pattern = '/([2-9]\d{8})$/';
                break;
            case 13:
	            $pattern = '/^\+351([2-9]\d{8})$/';
                break;
            default:
                return false;
        }
	    if(preg_match($pattern, $number, $matches)){
	        return array('number' => '+351' . $matches[1], 'country' => 'pt');
	    }else{
	        return false;
        }
        
    }
}
