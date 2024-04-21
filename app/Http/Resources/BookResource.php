<?php

namespace App\Http\Resources;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'isbn' => $this->isbn,
            'author' => SimpleResource::make($this->author),
            'publisher' => SimpleResource::make($this->publisher),
            'language' => SimpleResource::make($this->language),
            'bookType' => SimpleResource::make($this->bookType),
            'pages' => $this->pages,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
            'genres' => $this->when($this->genres->isNotEmpty(), SimpleResource::collection($this->genres)),
            'originalBook' => $this->when(!is_null($this->originalBook), OriginalBookResource::make($this->originalBook)),
            'created_precisely_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'created_before' => Carbon::parse($this->created_at)->diffForHumans()
        ];
    }
}
