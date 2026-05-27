<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CounselingMessage extends Model
{
    protected $fillable = [
        'counseling_session_id',
        'sender',
        'message',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(CounselingSession::class, 'counseling_session_id');
    }
}
