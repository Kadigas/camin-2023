<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CaminResource extends JsonResource
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
            'nama' => $this->nama,
            'angkatan_id' => $this->angkatan_id,
            'nrp' => $this->nrp,
            'jurusan' => $this->jurusan,
        ];
    }
}
