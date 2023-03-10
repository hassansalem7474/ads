<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
           'title' => 'required',
           'type' => 'required|boolean',
           'description' => 'required',
           'start_date' => 'required|date',
           'category_id' => 'required|exists:categories,id',
           'advertiser_id' => 'required|exists:advertisers,id',
        ];
    }
}