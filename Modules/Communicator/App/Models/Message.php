<?php

namespace Modules\Communicator\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

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

    function template()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
