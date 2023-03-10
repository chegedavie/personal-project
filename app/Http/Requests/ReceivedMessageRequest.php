<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceivedMessageRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email'=>'required|email',
            'subject'=>'required|min:3|max:255',
            'firstname'=>'required|alpha',
            'lastname'=>'required|alpha',
            'message'=>'required',
            'data'=>'json|nullable'
        ];
    }
}
