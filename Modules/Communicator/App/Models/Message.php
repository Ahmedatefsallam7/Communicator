<?php

namespace Modules\Communicator\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Message extends Model
{
    use HasFactory, SoftDeletes, Userstamps;


    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'template_id',
        'user_id',
        'app',
        'message_data',
        'status',
    ];

    protected $casts = [
        'template_id' => 'int',
        'user_id' => 'int',
    ];

    function template()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
