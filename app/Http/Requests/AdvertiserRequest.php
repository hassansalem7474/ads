<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertiserRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST': {
                    return [
                        'name' => 'required',
                        'email' => 'required|email|unique:advertisers',
                        'password' => 'required|min:8',
                    ];
                }
            case 'PUT': {
                    return [
                        'name' => 'required',
                        'email' => 'required|email|unique:advertisers,id,'.$this->segment(3),
                        'password' => 'required|min:8',
                    ];
                }
        }
    }
}