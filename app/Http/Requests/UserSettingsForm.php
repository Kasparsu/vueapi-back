<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSettingsForm extends FormRequest
{
    public function rules()
    {
        return [
            'age' => 'required|integer',
            'dark_mode_enabled' => 'required|boolean',
            'language_filter_enabled' => 'required|boolean',
        ];
    }

    public function onlyInRules()
    {
        return $this->only(array_keys($this->rules()));
    }
}
