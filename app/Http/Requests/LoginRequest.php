<?php

namespace App\Http\Requests;

use App\Rules\PassesGrecaptcha;
use Illuminate\Foundation\Http\FormRequest;
use Laravel\Fortify\Http\Requests\LoginRequest as RequestsLoginRequest;

class LoginRequest extends RequestsLoginRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
     
        // error_log(json_encode(request()->all()));
        return [
            // 'g-recaptcha-response' => [new PassesGrecaptcha]
        ];
    }
}
