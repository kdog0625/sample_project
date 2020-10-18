<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTweet extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //認証がfalseだとうまく行かない場合がある。
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
            //必須なものはrequiredを使う。
            'name'=> 'required|string|max:20',
            'title'=> 'required|string|max:50',
            'email'=> 'required|email|unique:users|max:255',
            'url'=> 'url|nullable',
            'gender'=> 'required',
            'age'=> 'required',
            'contact'=> 'required|string|max:200',
            'caution'=> 'required|accepted',
        ];
    }
}
