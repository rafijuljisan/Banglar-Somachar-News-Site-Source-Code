<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotocardFrame extends Model
{
    protected $fillable = ['image'];
    
    public $timestamps = true;
}