<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   
        // change what's and how's the data that you return.
        // you can return only specific data and you can change the names to comply with JSON conventions.

        return [
            'id' => $this->id,
            'title' => $this->title,
            // 'body' => $request->routeIs('articles.show') ? $this->body : null,
            'body' => $this->body,
            'categoryId' => $this->category_id,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
