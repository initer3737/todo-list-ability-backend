<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListCreateRequest extends FormRequest
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
            'list'=>['required','min:6'],
            'title_id'=>['required','min:1']
        ];
    }
}
