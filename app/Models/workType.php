<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkType extends Model
{
    use HasFactory;
    use HasFactory;

    protected $parentColumn = 'parent_id';

    protected $fillable = ['name', 'category', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(Test::class,$this->parentColumn);
    }

    public function children()
    {
        return $this->hasMany(Test::class, $this->parentColumn);
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }
}
