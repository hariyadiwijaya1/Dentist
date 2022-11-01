<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public $status;
    public $message;

    //untuk membuat format keluarnya data
    public function __construct($status, $message, $ressource = [])
    {
        parent::__construct($ressource);
        $this->status = $status;
        $this->message = $message;
    }

    //method bawaan resource
    public function toArray($request)
    {
        return [
            'status'    => $this->status,
            'message'   => $this->message,
            'data'      => $this->resource,
        ];
    }
}
