<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // protected by general tokens
        $user = $this->user();
        return $user != null && $user->tokenCan("create");
    }
 
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required','string','max:55'],
            'body_md_filepath' => ['required','string'],
            'description' => ['required', 'string'],
            'thumbnail' => ['required', 'string'],
            'category_id' => ['string']
        ];
    }

    protected function prepareForValidation() {
        // only cast it if there is a categoryId field provided in the payload
        if ($this->categoryId) {
            $this->merge([
                'category_id' => $this->categoryId,
                'body_md_filepath' => $this->bodyMdFilepath
                // 'categoryId' => 'category_id'
            ]);
        }
    }
}
