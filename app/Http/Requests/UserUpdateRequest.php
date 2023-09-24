<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
//        $userId = $this->user()->id;
//        $userId = $this->route('user')->id;
//        $userId = $this->segment(2);
        $userId = $this->route('user');

        return [
            'name' => 'string|max:255',
            'email' => [
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($userId),
            ],
            'password' => 'nullable|string|min:8|max:255',
        ];
    }
}
