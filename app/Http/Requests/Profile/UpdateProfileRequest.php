<?php

namespace App\Http\Requests\Profile;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        $user = request()->user();

        return [
            User::NAME => 'required',
            User::EMAIL => 'required|email|unique:users,email,' . $user->id,
        ];
    }
}
