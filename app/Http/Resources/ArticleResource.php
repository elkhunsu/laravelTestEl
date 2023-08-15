<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'publish_date' => $this->publish_date,
            'links' => [
                'self' => route('articles.index'),
                'next' => $this->collection->nextPageUrl(),
                'prev' => $this->collection->previousPageUrl(),
            ],
          ];
    }
}
