<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;

    // This tells Laravel: "Allow me to save data to any column in this table"
    protected $guarded = []; 
}

