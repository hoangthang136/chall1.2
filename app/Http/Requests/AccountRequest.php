<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
        return [
            'password' => 'required|min:8|max:16',
            'passwordConfirm' => 'required|min:8|max:16|same:password',
            'email' => 'required|email',
            'phone' => 'required|integer|min:9'
        ];
    }
        
    public function messages(): array
    {
        return [
            'password.required' => '*Vui lòng điền password',
            'password.min' => '*Vui lòng điền kí tự hoa, ký tự thường và độ dài từ 8-16 ký tự',
            'password.max' => '*Vui lòng điền kí tự hoa, ký tự thường và độ dài từ 8-16 ký tự',
            'passwordConfirm.required' => '*Vui lòng điền password',
            'passwordConfirm.min' => '*Vui lòng điền kí tự hoa, ký tự thường và độ dài từ 8-16 ký tự',
            'passwordConfirm.max' => '*Vui lòng điền kí tự hoa, ký tự thường và độ dài từ 8-16 ký tự',
            'passwordConfirm.same' => '*Mật khẩu không khớp',
            'email.email' => '*Vui lòng điền đúng địa chỉ email',
            'email.required' => '*Vui lòng điền địa chỉ email',
            'phone.required' => '*Vui lòng điền số điện thoại',
            'phone.integer' => '*Vui lòng điền số',
            'phone.min' => '*Vui lòng điền đúng 10 ký tựa'
        ];
    }
}
