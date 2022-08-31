<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Exercise extends Model
{
    //sortable plugin to be able to sort tables
    use Sortable;

    protected $fillable = ['name'];

    public $sortable = ["name", "category", "rating"];


    use HasFactory;
    public $primaryKey = 'id';
    public $updated_at = null;
    public $timestamps = false;
}

Exercise::all();
