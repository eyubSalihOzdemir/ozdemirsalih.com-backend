<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use function Psy\debug;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   
        // Change what's and how's the data that you return.
        // You can return only specific data and you can change the names to comply with JSON conventions.

        // Get query parameters from the request
        // $includeBody = $request->query('include_body', false);

        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'bodyMdFilepath' => $this->body_md_filepath,
            'categoryId' => $this->category_id,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];

        // Conditionally add 'body' attribute if requested.
        // if ($includeBody or ($request->route()->getActionMethod() === "show")) {
        //     $data['body'] = $this->body;
        // }

        return $data;
    }
}
