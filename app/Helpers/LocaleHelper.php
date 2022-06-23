<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Config;

class LocaleHelper
{
    public static function get_current_locale()
    {
        return Config::get('app.locale');
    }
}
