<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
        $rules = [
            'title' => 'required|max:255',
            'content' => 'required|max:255',
        ];

        //共通しないルール
        switch ($route) {
            case 'posts.store';
                $rules['input_file'] = 'required|file|image|mimes:jpeg,png,jpg,gif|max:1024';
                break;

            case 'posts.update';
                $rules['input_file'] = 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:1024';
                break;
        }

        return $rules;

    }
}
