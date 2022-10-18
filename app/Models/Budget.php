<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;
    protected $guarded = [];  

    public function workType(){
        return $this->belongsTo(WorkType::class, 'work_type');
    }

    public function getRemainingBudget()
    {
        return $this->attributes['budget'] - $this->workType->getTotalPurchasedAmount($this->attributes['project_id']);
    }
}
