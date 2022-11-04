<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
            'name' => 'required|string|max:50'
        ];

        //共通しないルール
        switch ($route) {
            case 'user.profile_update';
                $rules['sex'] = 'required|string|max:1';
                $rules['input_image'] = 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:1024';
                $rules['location'] = 'nullable|string|max:30';
                $rules['introduction'] = 'nullable|string|max:160';
                break;
        }

        return $rules;
    }
}
