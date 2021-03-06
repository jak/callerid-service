<?php
if (!defined('CALLERID')) {
    // This check helps protect against security problems;
    // your code file can't be executed directly from the web.
    exit(1);
}

abstract class Source
{
    public $countries = null;
    public $run_param;
    
    function get_configuration()
    {
        return array();
    }
    
    abstract function lookup();
    
    function prepare(){
        if($this->countries == null){
            return true;
        }else{
            //make sure that the phone number's country is supported by this source
            return in_array($this->country, $this->countries);
        }
    }
    
    /**
     * given a block of messy, scraped html contains tags, escape sequences, etc, return a cleaned up string ready to be displayed to the user
     * 
     * if the parameter is empty, return null
     * removes multiple white spaces
     * replaces new line with spaces, 
     * convert html entities to unicode characters
     * strips html tags
     * trim leading/trailing white space
     */
    function clean_scraped_html($html){
        if(empty($html))
            return null;
        else
            $ret = trim(preg_replace('/[\p{Z}\s]+/m',' ',html_entity_decode(strip_tags($html),ENT_QUOTES,'UTF-8')));
            $ret = $this->convert_to_utf8($ret);
            if(empty($ret)){
                return null;
            }else{
                return $ret;
            }
    }

    function convert_to_utf8($content) {
        //from http://www.php.net/manual/en/function.utf8-encode.php#102382
        if(!mb_check_encoding($content, 'UTF-8')
            OR !($content === mb_convert_encoding(mb_convert_encoding($content, 'UTF-32', 'UTF-8' ), 'UTF-8', 'UTF-32'))) {

            $content = mb_convert_encoding($content, 'UTF-8');
        }
        return $content;
    }
}

