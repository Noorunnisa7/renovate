<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExampleRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|min:3|max:20|regex:/^[a-z A-Z 0-9\/-]+$/|unique:agency_clients,name,NULL,id,deleted_at,NULL,agency_id,' . request()->input('agency_id'),
            'email' => 'required|email|max:100',
            'country' => 'string|alpha|size:2',
            'country_code' => 'regex:/^\+\d{1,5}$/',
            'phone' => 'string|regex:/[0-9]{8}/',
            'image' => 'Base64Image|Base64ImageSize:2000',//KB
            'billing_currency' => 'required|string|max:3',
            'tax_rate_id' => 'exists:tax_rates,id,agency_id,'.request()->input('agency_id'),
        ];

        //for update case
        if($this->route('client_id')){
            $rules['name'] = 'required|string|min:3|max:20|regex:/^[a-z A-Z 0-9\/-]+$/|unique:agency_clients,name,'.request()->route('client_id')->id.',id,deleted_at,NULL,agency_id,' . request()->input('agency_id');
            unset($rules['billing_currency']);
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'image.base64_image' => 'The image field must have one of the following extensions: jpg, png, jpeg.',
            'image.base64_image_size' => 'The image field must not be greater than 2MBs.',
        ];
    }
}
