<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
        $uniqueEmail = auth()->user()?'required|email':'required|email|unique:users';
        return [
            'email'=>$uniqueEmail,
            'name'=>'required',
            'address'=>'required',
            'city'=>'required',
            'prefecture'=>'required',
            'postal-code'=>'required',
            'phone'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'email.unique'=>"既に同じメールアドレスで登録されています<a href='/login'>ログイン</a>をしてから続行してください"
        ];
    }

}
