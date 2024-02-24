<?php

namespace Modules\Communicator\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'type',
        'path',
        'body',
        'subject',
        'sender',
        'variable',
        'attachment',
        'cc',
        'bcc',
    ];

    function messages()
    {
        return $this->hasMany(Message::class);
    }
}
