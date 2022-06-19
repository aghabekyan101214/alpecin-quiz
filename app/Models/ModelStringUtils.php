<?php


namespace App\Models;


trait ModelStringUtils
{

    public function translations_string_ul($key='name')
    {
        $str = '<ul>';
        foreach ($this->translations as $t) {
            $str .= "<li>"."(".$t->language->language_code.") ".$t->{$key}."</li>";
        }
        $str .= "</ul>";
        return $str;
    }

        public function translations_string($key='name')
    {
        $str = "";
        foreach ($this->translations as $t) {
            $str .= "(".$t->language->language_code.") ".$t->{$key}." \n";
        }
        return $str;
    }
}
