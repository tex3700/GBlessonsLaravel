<?php

namespace App\Http\Requests\News;

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
    #[ArrayShape(['category_id' => "string[]", 'title' => "string[]", 'text' => "string[]", 'isPrivate' => "string[]", 'image' => "string[]"])]
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'exists:news_categories,id'],
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'text' => ['required', 'string', 'min:30', 'max:1000'],
            'isPrivate' => ['required', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpg,png'],
        ];
    }

    #[ArrayShape(['category_id' => "string", 'title' => "string", 'text' => "string", 'isPrivate' => "string"])]
    public function attributes(): array
    {
        return [
            'category_id' => '"Категория новости"',
            'title' => '"Заголовок новости"',
            'text' => '"Текст новости"',
            'isPrivate' => '"Приватность"',
        ];
    }
}
