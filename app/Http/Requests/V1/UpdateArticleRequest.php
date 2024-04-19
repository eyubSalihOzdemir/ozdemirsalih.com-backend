<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // protected by general tokens
        $user = $this->user();
        return $user != null && $user->tokenCan("update");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if($method == "PUT") {
            return [
                'title' => ['required','string','max:55'],
                'body' => ['required','string'],
                'description' => ['required', 'string'],
                'thumbnail' => ['required', 'string'],
                'category_id' => ['string'], 
            ];
        } else {
            return [
                'title' => ['sometimes', 'required','string','max:55'],
                'body' => ['sometimes', 'required','string'],
                'description' => ['sometimes', 'string'],
                'thumbnail' => ['sometimes', 'string'],
                'category_id' => ['sometimes', 'string']
            ];
        }
        
    }

    protected function prepareForValidation() {
            if($this->categoryId) {
                $this->merge([
                'category_id' => $this->categoryId
                // 'categoryId' => 'category_id'
            ]);
        }
    }
}
