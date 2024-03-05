<?php

namespace Modules\Communicator\App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';

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
        return $this->hasMany(Message::class, 'template_id');
    }
}
