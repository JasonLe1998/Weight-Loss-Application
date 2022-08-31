<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    public $primaryKey = 'id';
    public $updated_at = null;

    //create a relationship with the user to show that a history record belongs to a user
    public function user(){
        return $this->belongsTo("App\Models\User");
    }
    
}

History::all();
