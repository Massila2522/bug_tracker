<?php

namespace App\Models;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'ticket_id',
        'author'
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function commentAuthor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
