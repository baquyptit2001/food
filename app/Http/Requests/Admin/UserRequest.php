<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'password' => 'sometimes|nullable|string|min:8',
            'password_confirmation' => 'sometimes|nullable|required_with:password|string|min:8|same:password',
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
            'password.string' => 'Mật khẩu phải là chuỗi',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password_confirmation.required_with' => 'Xác nhận mật khẩu không được để trống',
            'password_confirmation.string' => 'Xác nhận mật khẩu phải là chuỗi',
            'password_confirmation.min' => 'Xác nhận mật khẩu phải có ít nhất 6 ký tự',
            'password_confirmation.same' => 'Xác nhận mật khẩu không khớp',
        ];
    }
}
