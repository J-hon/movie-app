<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    protected $fillable = [
        'id',
        'title',
        'overview',
        'image',
        'release_date'
    ];

    protected $dates = [
        'release_date'
    ];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'movie_lists');
    }
}
