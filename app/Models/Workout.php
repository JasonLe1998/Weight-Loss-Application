<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Workout extends Model
{

    //sortable plugin to be able to sort tables
    use Sortable;

    protected $fillable = ['workoutName'];

    public $sortable = ["workoutName"];

    use HasFactory;
    public $primaryKey = 'id';
    public $updated_at = null;
    public $timestamps = false;

    //create a relationship with the user to show that a workout plan belongs to a user
    public function user(){
        return $this->belongsTo("App\Models\User");
    }
}

Workout::all();
