<?php

namespace Classie\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:5',
            'body' => 'required|min:10',
            'images.*' => 'nullable|json',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'title.min' => 'Title must be at least 5 characters',
            'body.required' => 'Body is required',
            'body.min' => 'Body must be at least 10 characters',
        ];
    }

    public function passedValidation()
    {
        if ($this->has('images')) {
            $images = [];
            foreach ($this->input('images') as $image) {
                $images[] = json_decode($image);
            }
            $this->merge(['images' => $images]);
        }
    }
}
