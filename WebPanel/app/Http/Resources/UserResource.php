<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $roles = [];
        foreach($this->roles()->get()->pluck(['id']) as $id){
            array_push($roles, ['id' => $id]);
        }
        return [
            'id' => $this->id,
            'username' => $this->username,
            'roles' => $roles
        ];
    }
}
