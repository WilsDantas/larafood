<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;


class TenantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'          => $this->name,
            'image'         => $this->logo ? url("storage/{$this->logo}") : '',
            'identify'      => $this->uuid,
            'flag'          => $this->url,
            'contact'       => $this->email,
            'date_created'  =>  Carbon::parse($this->created_at)->format('d/m/Y'),
        ];
    }
}
