<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FavouriteAlbum extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_mbid', 'album_name', 'user_id'
    ];

    /**
     * Get the user that owns the FavouriteArtist
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
