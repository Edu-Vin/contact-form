<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|regex:/^.+@.+\..+/|max:255',
            'message' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,xlsx,text/csv|max:200',
        ];
    }

    public function messages()
    {
        return [
            'attachment.mimes' => 'attachment must be a file of type pdf, xlsx or csv.',
        ];
    }
}
