<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
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
        return [
            'title' => ['sometimes', 'max:255'],
            'isbn' => ['sometimes', 'integer', 'min:1', Rule::unique('books', 'isbn')->ignore($this->route('book'))],
            'author_id' => ['sometimes', 'integer', Rule::exists('authors', 'id')],
            'publisher_id' => ['sometimes', 'integer', Rule::exists('publishers', 'id')],
            'published_at' => ['sometimes', 'date_format:Y-m-d H:i:s', 'before_or_equal:' . Carbon::now()->toDateTimeString()],
            'language_id' => ['sometimes', 'integer', Rule::exists('languages', 'id')],
            'book_type_id' => ['sometimes', 'integer', Rule::exists('book_types', 'id')],
            'pages' => ['sometimes', 'integer', 'min:1'],
            'original_book_id' => ['sometimes', 'nullable', 'integer',  Rule::exists('books', 'id')],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
