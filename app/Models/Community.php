<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Community extends Model
{
    use HasFactory;
    public $primaryKey = 'id';
    public $updated_at = null;

    //sortable plugin to be able to sort tables
    use Sortable;

    protected $fillable = ['title', 'description', "userName", "user_id"];

    public $sortable = ["title", "userName"];
    
}

Community::all();
