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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'genres' => GenreResource::collection($this->genres),
            'created_precisely_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'created_before' => Carbon::parse($this->created_at)->diffForHumans()
        ];
    }
}
