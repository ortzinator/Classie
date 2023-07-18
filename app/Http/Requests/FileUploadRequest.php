<?php

namespace Classie\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FileUploadRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'image' => [
                'required',
                'image',
                'max:2048'
            ]
        ];
    }

    public function authorize(): bool
    {
        return Auth::check();
    }
}
