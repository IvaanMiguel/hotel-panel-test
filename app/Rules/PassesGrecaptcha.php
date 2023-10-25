<?php

namespace App\Rules;

use App\Models\Setting;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class PassesGrecaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // error_log($value);
        $settings = Setting::first();

        if($settings && $settings->google_recaptcha){
            $response = Http::asForm()->get('https://www.google.com/recaptcha/api/siteverify', [
                'response' => $value,
                'secret' => Setting::first()->google_recaptcha_private_key
            ])->object();
           
            error_log(json_encode($response));

            if(is_null($response) || !$response->success){
                $fail('Google reCaptcha ha fallado');
            }
        }
    }
}
