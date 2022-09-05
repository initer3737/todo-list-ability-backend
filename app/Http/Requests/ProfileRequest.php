<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
                'name'=>['required','min:4','max:16'],
                'username'=>['required','min:5','max:15'],
                'foto_profile'=>['required','nullable','file','max:1024','image'],
                'alamat'=>['required','min:10','max:65'],
                'no_telp'=>['required','min:9','numeric'],
                'gender'=>['required','min:1','max:1'],
                'email'=>['required','email'],
                'password'=>['required','min:6']
        ];
    }
}
