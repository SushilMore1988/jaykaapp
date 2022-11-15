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
        // $qty = StockTransfer::where('destination_project_id',$this->attributes['project_id'])->sum('quantity');
        // $qty = StockTransfer::where('destination_project_id',$this->attributes['project_id'])->get();
        // dd($this->workType);
        $budget = 0;
        $stockMoves = StockMove::where('transaction_type', 'STOCKMOVEIN')->where('project_id',$this->attributes['project_id'])->get();
        foreach($stockMoves as $stockMove){
            $price = $stockMove->item->purchasePrices->price;
            if($stockMove->item->work_type_id == $this->workType->id){
                $budget += ($stockMove->quantity * $price);
            }
        }
        return $this->attributes['budget'] - $this->workType->getTotalPurchasedAmount($this->attributes['project_id']) - $budget;
    }
}
