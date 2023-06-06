<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateLesson extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $uuid = $this->lesson ?? '';
        return [
            'module'=>['required','min:3','max:255'],
            'name' =>['required', 'min:3','max:255',"unique:courses,name,{$uuid},uuid"],
            'video' =>['required', 'min:3','max:255',"unique:courses,name,{$uuid},uuid"],
            'description' =>['nullable','min:3','max:9999'],
        ];
    }
}
