<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarrierUpdateRequest extends FormRequest
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
            'carrier'=> 'required|max:255',
            'pol' => 'required|max:255',
            'pod' => 'required|max:255',
            'freight' => 'required|max:255|unique:carriers,freight,'.$this->id,
            'expired' => 'required',
            'effective' => 'required',
        ];
    }
}
