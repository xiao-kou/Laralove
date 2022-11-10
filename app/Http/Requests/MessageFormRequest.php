<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MessageFormRequest extends FormRequest
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
        //現在のrouteの名前を取得
        $route = $this->route()->getName();

        //共通するルール
        $rules = [];

        //共通しないルール
        switch ($route) {
            case 'messages.send';
                $rules['text'] = ['nullable', 'required_without:input_file', 'max:255'];
                $rules['input_file'] = ['nullable', 'required_without:text', 'file', 'image', 'mimes:jpeg,png,jpg,gif'];
                break;
        }

        return $rules;
    }

    //ajax用のバリデーション
    protected function failedValidation(Validator $validator)
    {
        $res = response()->json([
                'errors' => $validator->errors(),
            ],
            400);
        throw new HttpResponseException($res);
    }
}
