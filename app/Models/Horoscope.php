<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horoscope extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'zodiac_sign',
        'date',
        'type',
        'description',
        'love_rating',
        'career_rating',
        'wellness_rating',
        'lucky_number',
        'lucky_color'
    ];

    /**
     * Get formatted date for display
     */
    public function getFormattedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->date)->format('F j, Y');
    }

    /**
     * Get formatted type for display
     */
    public function getFormattedTypeAttribute()
    {
        return ucfirst($this->type);
    }
}
