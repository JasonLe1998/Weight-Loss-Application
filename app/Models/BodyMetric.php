<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodyMetric extends Model
{
    use HasFactory;
    public $primaryKey = 'id';
    public $updated_at = null;

    //create a relationship with the user to show that a bodymetric belongs to a user
    public function user(){
        return $this->belongsTo("App\Models\User");
    }
}

BodyMetric::all();
