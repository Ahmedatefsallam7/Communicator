<?php

namespace Modules\Communicator\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'app' => $this->app,
            'message_data' => $this->message_data,
            'status' => $this->status,
            'template_id' => $this->template_id,
            'user_id' => $this->user_id,
            'template' => $this->template,
            'user' => $this->user,
        ];
    }
}
