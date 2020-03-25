<?php

namespace Modules\Auth\Http\Requests;

use App\User;
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
            User::NAME => ['required', 'string', 'max:255'],
            User::EMAIL => ['required', 'string', 'email', 'max:255', 'unique:users'],
            User::PASSWORD => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
