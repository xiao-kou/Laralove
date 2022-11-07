<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\alpha_num_check;
use App\Rules\current_password_check;

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
        $rules = [];
        $a = new alpha_num_check();

        //共通しないルール
        switch ($route) {
            case 'users.update';
                $rules['screen_name'] = ['filled', 'string', 'min:4', 'max:14', 'unique:users', new alpha_num_check()];
                $rules['email'] = ['filled', 'string', 'email', 'max:255', 'unique:users'];
                $rules['current_password'] = ['filled', 'string', 'min:8', new current_password_check()];
                $rules['new_password'] = ['filled', 'string', 'min:8'];
                break;

            case 'users.profile_update';
                $rules['name'] = 'required|string|max:50';
                $rules['sex'] = 'required|string|max:1';
                $rules['input_image'] = 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:1024';
                $rules['location'] = 'nullable|string|max:30';
                $rules['introduction'] = 'nullable|string|max:160';
                break;
        }

        return $rules;
    }
}
