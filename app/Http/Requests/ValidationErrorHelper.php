<?php


namespace App\Http\Requests;


trait ValidationErrorHelper
{
    public function throw_error($key, $err)
    {
        $error = \Illuminate\Validation\ValidationException::withMessages([
            $key => $err
        ]);
        throw $error;
    }
}
