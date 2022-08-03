<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['name' => "string", 'email' => "string", 'password' => "string", 'password_confirmation' => "string"])] public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'sometimes|required|string|min:8|same:password',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */

    public function messages(): array
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.string' => 'Tên phải là chuỗi',
            'name.max' => 'Tên không được vượt quá 255 ký tự',
            'email.required' => 'Email không được để trống',
            'email.string' => 'Email phải là chuỗi',
            'email.email' => 'Email không hợp lệ',
            'email.max' => 'Email không được vượt quá 255 ký tự',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.string' => 'Mật khẩu phải là chuỗi',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password_confirmation.required' => 'Xác nhận mật khẩu không được để trống',
            'password_confirmation.string' => 'Xác nhận mật khẩu phải là chuỗi',
            'password_confirmation.min' => 'Xác nhận mật khẩu phải có ít nhất 6 ký tự',
            'password_confirmation.same' => 'Xác nhận mật khẩu không khớp',
        ];
    }
}
