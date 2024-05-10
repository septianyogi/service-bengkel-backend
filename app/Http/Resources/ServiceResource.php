<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'tanggal' => $this->tanggal,
            'services' => $this->whenLoaded('serviceByTanggal', function() {
                return collect($this->serviceByTanggal)->each(function($service) {
                    $service->services;
                    return $service;
                });
            })
        ];
    }
}
