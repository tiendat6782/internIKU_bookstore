<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $rule = [];
        $currentAction = $this->route()->getActionMethod();
        switch ($this->method()) {
            case 'POST':
                switch ($currentAction) {
                    case 'insert':
                        $rule = [
                            'name' => 'required',
                            'price' => 'required',
                            'soLuong' => 'required',
                            'description' => 'required',
                            'author'=>'required'
                        ];
                        break;
                    default:
                        break;
                }
                break;
            default:
                break;
        }
        return $rule;
    }
    public function messages()
    {
        return [
            'name.required' => 'Required to fill in the Name',
            'price.required' => 'Required to fill in the price',
            'soLuong.required' => 'Required to fill in the soLuong',
            'description.required' => 'Required to fill in the Description',
            'author.required' => 'Required to fill in the Description',
        ];
    }
}