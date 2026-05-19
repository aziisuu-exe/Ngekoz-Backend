<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KosPlaceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'location' => [
                'address' => $this->address,
                'district' => $this->whenLoaded('district', fn() => $this->district->name),
                'city' => $this->whenLoaded('district', fn() => $this->district->city->name ?? null),
                'coordinates' => [
                    'latitude' => $this->latitude,
                    'longitude' => $this->longitude,
                ]
            ],
            'price' => [
                'raw' => $this->price_start_from,
                'formatted' => 'Rp ' . number_format($this->price_start_from, 0, ',', '.')
            ],
            'rating' => $this->rating_avg,
            'facilities' => $this->whenLoaded('facilities', fn() => $this->facilities->map(fn($f) => [
                'id' => $f->id,
                'name' => $f->name,
                'icon' => $f->icon_name
            ])),
            'thumbnail' => $this->whenLoaded('photos', fn() => $this->photos->first()->image_url ?? null),
        ];
    }
}