<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'hoten' => 'required|max:255',
            // ,username, .$this->id là để cập nhật không bị check là đã tồn tại
            'username' => 'required|unique:user,username,'.$this->id,
            'password' => 'required|min:8|max:16',
            'email' => 'required|email',
            'phone' => 'required|integer|min:9'
        ];
    }
    
    public function messages(): array
    {
        return [
            'hoten.required' => '*Vui lòng điền tên của bạn',
            'hoten.max' => '*Vui lòng điền không quá 255 ký tự',
            'username.required' => '*Vui lòng điền username',
            'username.unique' => "*$this->username đã tồn tại",
            'password.required' => '*Vui lòng điền password',
            'password.min' => '*Vui lòng điền kí tự hoa, ký tự thường và độ dài từ 8-16 ký tự',
            'password.max' => '*Vui lòng điền kí tự hoa, ký tự thường và độ dài từ 8-16 ký tự',
            'email.email' => '*Vui lòng điền đúng địa chỉ email',
            'email.required' => '*Vui lòng điền địa chỉ email',
            'phone.required' => '*Vui lòng điền số điện thoại',
            'phone.integer' => '*Vui lòng điền số',
            'phone.min' => '*Vui lòng điền đúng 10 ký tựa'
        ];
    }
}
