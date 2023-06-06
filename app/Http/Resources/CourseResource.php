<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'identify'=>$this->uuid,
            'title'=>$this->name,
            'description'=>$this->description,
            'date' => Carbon::make($this->created_at)->format('y-m-d'),
            'modules'=>ModuleResource::collection($this->whenLoaded('modules'))
        ];
    }
}
