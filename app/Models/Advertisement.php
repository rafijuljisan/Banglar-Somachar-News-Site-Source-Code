<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    // Ensure these match your database columns
    protected $fillable = [
        'add_placement', // Position (Header, Footer, etc.)
        'addSize',       // Size info
        'banner_type',   // 'upload', 'url', or 'code'
        'photo',         // Filename of uploaded image
        'photo_url',     // External image URL
        'link',          // Redirect URL (Where user clicks)
        'banner_code',   // Legacy HTML code
        'status'
    ];

    public $timestamps = false; // Disable if your table doesn't have created_at/updated_at

    // Helper to get the correct image source
    public function getDisplayImageAttribute()
    {
        if ($this->banner_type == 'upload') {
            return asset('assets/images/ads/' . $this->photo);
        } elseif ($this->banner_type == 'url') {
            return $this->photo_url;
        }
        return null;
    }
}