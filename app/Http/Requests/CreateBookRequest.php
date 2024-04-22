<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreateBookRequest extends FormRequest
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
            'title' => ['required', 'max:255'],
            'isbn' => ['required', 'integer', 'min:1', Rule::unique('books', 'isbn')],
            'author_id' => ['required', 'integer', Rule::exists('authors', 'id')],
            'publisher_id' => ['required', 'integer', Rule::exists('publishers', 'id')],
            'published_at' => ['date_format:Y-m-d H:i:s', 'before_or_equal:' . Carbon::now()->toDateTimeString()],
            'language_id' => ['required', 'integer', Rule::exists('languages', 'id')],
            'book_type_id' => ['required', 'integer', Rule::exists('book_types', 'id')],
            'pages' => ['integer', 'min:1'],
            'original_book_id' => ['nullable', 'integer',  Rule::exists('books', 'id')],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
