<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'=>['required','string','min:6','max:12'],
            'username'=>['required','min:6','max:12'],
            'email'=>['required','email','unique:users'],
           'password'=>['required','min:6','max:12'],
           'c_password'=>['required','same:password']
        ];
    }
}
