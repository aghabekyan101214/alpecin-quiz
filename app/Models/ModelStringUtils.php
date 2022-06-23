<?php


namespace App\Models;


trait ModelStringUtils
{

    public function translations_string_ul($key='name')
    {
        $str = '<ol>';
        foreach ($this->current_language as $t) {
            $str .= "<li>"."(".$t->language->language_code.") ".$t->{$key}."</li>";
        }
        $str .= "</ol>";
        return $str;
    }

        public function translations_string($key='name')
    {
        $str = "";
        foreach ($this->current_language as $t) {
            $str .= $t->{$key}." \n";
        }
        return $str;
    }
}
