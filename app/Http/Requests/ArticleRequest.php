<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ArticleRequest extends FormRequest
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
        if ($this->method('POST')) {
            return [
                'title'         => 'required|unique:articles|Max:100',
                'body'          => 'required',
                'category_id'   => 'required|exists:categories,id|numeric|min:1',
                'status'        => 'required'
            ];
        }else {
            return [
                'title'         => 'required|unique:articles|Max:100',
                'body'          => 'required',
                'category_id'   => 'required|exists:categories,id|numeric|min:1',
                'status'        => 'required'
            ];
        }
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'code'      => (int) 422,
                'message'   => (string) config('code.'. 422, "The given data was invalid."),
                'data'      => $validator->errors(),
                'error'     => null
            ], 422)
        );
    }
}
