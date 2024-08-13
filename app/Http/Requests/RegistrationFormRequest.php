<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // in Laravel, when there is regex validation, the documentation states that it is recommended
        // to specify the validation rules using array instead of being separated by pipeline.
        return [
            "vacation-date" => "required",
            "adult" => "required|min:1|numeric",
            "first-name" => [
                'required',
                // This regex should allow any character from any language to be inputted.
                // we don't want numbers in the name.
                "regex:/(^[a-zA-Z\xC0-\uFFFF]+([ \\-']{0,1}[a-zA-Z\xC0-\uFFFF]+){0,2}[.]{0,1}$)/u"
            ],
            "last-name" => [
                'required',
                // This regex should allow any character from any language to be inputted.
                // we don't want numbers in the name.
                "regex:/(^[a-zA-Z\xC0-\uFFFF]+([ \\-']{0,1}[a-zA-Z\xC0-\uFFFF]+){0,2}[.]{0,1}$)/u"
            ],
            "gender" => "required",
            "street" => [
                "required",
                "regex:/(^[^!\?\{\(\[\*%&_=:<>]+$)/u"
            ],
            "city" => [
                "required",
                "regex:/(^[^!\?\{\(\[\*%&_=:<>]+$)/u"
            ],
            "email" => "required|email",
            "country" => "required",
            "zip-code" => [
                "required",
                "regex:/(^[0-9]{4}$)/u"
            ],
            "phone-number" => [
                "required",
                "regex:/(^[^a-zA-z]+$)/u"
            ]
        ];
    }
}
