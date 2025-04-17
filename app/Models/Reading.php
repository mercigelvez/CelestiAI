<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'spread_type',
        'question',
        'cards',
        'interpretation',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'cards' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the reading.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the formatted spread type.
     *
     * @return string
     */
    public function getFormattedSpreadTypeAttribute()
    {
        return match($this->spread_type) {
            'single' => 'Single Card',
            'three-card' => 'Past, Present, Future',
            'celtic-cross' => 'Celtic Cross',
            'relationship' => 'Relationship Spread',
            'career' => 'Career Path',
            default => ucfirst(str_replace('-', ' ', $this->spread_type)),
        };
    }
}
