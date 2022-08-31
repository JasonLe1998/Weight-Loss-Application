<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ExerciseReport extends Model
{
    use HasFactory;
    public $primaryKey = 'id';
    public $updated_at = null;
    public $timestamps = false;
}

ExerciseReport::all();
