<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['title' => "string[]", 'slug' => "string[]"])]
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'unique:news_categories', 'min:3', 'max:100'],
            'slug' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => '"Название категории"',
        ];
    }

}
