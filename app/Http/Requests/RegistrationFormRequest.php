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
        return true;
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
                "regex:/^[a-zA-ZäöüßÄÜÖẞ]+([ \\-']{0,1}[a-zA-ZäöüßÄÜÖẞ]+){0,2}[.]{0,1}$/"
            ],
            "last-name" => [
                'required',
                // This regex should allow any character from any language to be inputted.
                // we don't want numbers in the name.
                "regex:/^[a-zA-ZäöüßÄÜÖẞ]+([ \\-']{0,1}[a-zA-ZäöüßÄÜÖẞ]+){0,2}[.]{0,1}$/"
            ],
            "gender" => "required",
            "street" => [
                "required",
                "regex:/^[^!\?\{\(\[\*%&_=:<>]+$/"
            ],
            "city" => [
                "required",
                "regex:/^[^!\?\{\(\[\*%&_=:<>]+$/"
            ],
            "email" => "required|email",
            "country" => "required",
            "zip-code" => [
                "required",
                "regex:/^[0-9]{4}$/"
            ],
            "phone-number" => [
                "nullable",
                "regex:/^[^a-zA-z]+$/"
            ],
            // Using wildcard for each field from each child.
            'children.*.name' =>'required',
            'children.*.birthdate' =>'required',
            'children.*.birthmonth' =>'required',
            'children.*.birthyear' =>'required',
        ];
    }
}
