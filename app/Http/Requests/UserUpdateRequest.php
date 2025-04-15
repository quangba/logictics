<?php

namespace App\Http\Requests;

use App\Rules\EmailWithDot;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = $this->segment(2);
        return [
            'name' => 'required|max:255',
            'email' => ['email', 'required', 'unique:users,email,' . $userId, 'max:255', new EmailWithDot()],
            'password' => 'nullable|min:6|max:255',
        ];
    }
}
