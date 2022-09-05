<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ResetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {   
        /**
         * @jika request ini memerlukan hak akses maka ubah true menjadi false
         */
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
            'reset_token'=>['required','min:6','max:6'],
            'email'=>['required','email'],
           'password'=>['required','min:6','max:12'],
           'c_password'=>['required','same:password']
        ];
    }
}
