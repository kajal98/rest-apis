<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Hobby;

class User extends JsonResource
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
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'slug' => $this->slug,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at->diffForHumans(),
            'mobile' => $this->mobile,
            'photo' => $this->photo,
            'status' => $this->status ? 'Active' : 'Deactive',
            'hobbies' =>  $this->hobby_ids ? Hobby::whereIn('id', $this->hobby_ids)->get('name')->pluck('name') : [],
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
