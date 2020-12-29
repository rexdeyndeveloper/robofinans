<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSendTransaction extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => 'required|numeric',
            'destination_user_id' => 'required|exists:users,id'
        ];
    }
}
