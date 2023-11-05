<?php

namespace App\Models;

use App\Models\Project;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'type',
        'time_estimated',
        'author',
        'project_id'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function ticketAuthor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author');
    }

    public function devs(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'ticket_dev');
    }
}
