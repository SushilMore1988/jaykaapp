<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\WorkTypeDataTable;
use App\Models\WorkType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class WorkTypeController extends Controller
{

    // public function __construct(Report $report)
    // {
    //     $this->report = $report;
    // }

    public function index(WorkTypeDataTable $dataTable)
    {
        $data = ['menu' => 'work-type', 'header' => 'work-type', 'page_title' => __('Work Type')];
        // $data['stockMoves'] = DB::table('items')
        //                   ->select('items.*',DB::raw('SUM(stock_moves.quantity) as qty'))
        //                   ->leftJoin('stock_moves', 'stock_moves.item_id', '=', 'items.id')
        //                   ->where('items.alert_quantity', '>=', DB::raw('quantity'))
        //                   ->groupBy('items.id')
        //                   ->get();
        // $data['itemData'] = DB::table('items')->count();
        // $data['itemQuantity'] = DB::table('stock_moves')->select(DB::raw('SUM(quantity) as total_item'))->first();
        // $row_per_page = Preference::getAll()->where('category', 'preference')->where('field', 'row_per_page')->first('value')->value;
        // $currency = Currency::getDefault();
        // return $dataTable->with('row_per_page', $row_per_page)->with('currency', $currency)->render('admin.workType.view', $data);
        $data['workTypes'] = WorkType::all();
        // dd('here');
        return $dataTable->render('admin.workType.view', $data);
    }

    public function create()
    {
        $data = ['menu' => 'item', 'page_title' => __('Create Work Type')];

        // $unit = DB::table('item_units')->get();
        // $unit_name = array();
        // foreach ($unit as $value) {
        //     $unit_name[$value->id] = $value->name;
        // }

        // $data['unit_name']    = $unit_name;
        // $data['locData']      = Location::getAll();
        // $data['taxTypes']     = TaxType::getAll();
        // $data['saleTypes']    = DB::table('sale_types')->get();
        // $data['categoryData'] = StockCategory::where('is_active', 1)->get();
        // $data['unitData']     = DB::table('item_units')->get();
        $data['workTypes']     = DB::table('work_types')->where('parent_id', null)->get();

        return view('admin.workType.add', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required'
        ]);
        WorkType::create([
            'name' => $request->name,
            'category' => $request->category,
            'parent_id' => $request->parent_id ?? null,
        ]);
        Session::flash('success', __('Successfully Saved'));
        return back();
    }

}

