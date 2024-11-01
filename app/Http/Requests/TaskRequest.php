<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $postRules=[];
        $putRules=[];

        $rules = [
            'name' => ['string', 'min:3', 'max:100'],
            'cost' => ['numeric', 'min:0'],
            'end_date' => ['date'],
        ];

        if($this->isMethod('post')){
            $postRules = [
                'name' => ['required'],
                'cost' => ['required'],
                'end_date' => ['required'],
            ];
        }
        else{

            if($this->isMethod('put')){
                $putRules = [
                    'name' => ['sometimes'],
                    'cost' => ['sometimes'],
                    'end_date' => ['sometimes'],
                ];
            }
        }


        return array_merge_recursive($rules, $postRules, $putRules);
    }
}
