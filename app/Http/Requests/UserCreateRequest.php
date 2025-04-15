<?php

namespace App\Http\Requests;

use App\Rules\EmailWithDot;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
        return [
            'name' => 'required|max:255',
            'email' => ['email', 'required', 'unique:users', 'max:255', new EmailWithDot()],
            'password' => 'required|min:6|max:255'
        ];
    }
}
