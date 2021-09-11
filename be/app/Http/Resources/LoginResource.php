<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
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
            'token' => $this->createToken('OSPAC')->accessToken,
        ];
    }

    public function with($request){
        return [
          'status'=>'success'
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode(200, 'Ok');
    }
}
