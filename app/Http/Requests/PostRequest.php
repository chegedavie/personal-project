<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'=> 'required|max:150',
            'body'=>'required|min:1000',
            'description'=>'required|min:50|max:1000',
            'keywords'=>'required|min:5',
            'featured'=>'nullable|boolean',
            'id'=>'nullable',
            'user_id'=>'nullable|numeric',
            'published'=>'boolean'
        ];
    }
}
