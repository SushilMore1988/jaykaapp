<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Start\Helpers;
use Intervention\Image\ImageManagerStatic as Image;
use Session;
use Excel;
use Input;
use DB;
use Validator;
use App\Models\Currency;
use App\Models\StockCategory;
use App\Models\Item;
use App\Models\ItemCustomVariant;
use App\Models\Location;
use App\Models\Preference;
use App\Models\Report;
use App\Models\StockMove;
use App\Models\TaxType;
use App\Models\File;
use \Milon\Barcode\DNS1D;
use Datatables;
use App\DataTables\ItemDataTable;
use App\DataTables\VariantDatatable;
use PDF;
use App\Exports\ItemListExport;
use App\Rules\CheckValidFile;

class WorkTypeController extends Controller
{

    // public function __construct(Report $report)
    // {
    //     $this->report = $report;
    // }

    public function index(ItemDataTable $dataTable)
    {
        $data = ['menu' => 'item', 'header' => 'item', 'page_title' => __('Items')];
        $data['stockMoves'] = DB::table('items')
                          ->select('items.*',DB::raw('SUM(stock_moves.quantity) as qty'))
                          ->leftJoin('stock_moves', 'stock_moves.item_id', '=', 'items.id')
                          ->where('items.alert_quantity', '>=', DB::raw('quantity'))
                          ->groupBy('items.id')
                          ->get();
        $data['itemData'] = DB::table('items')->count();
        $data['itemQuantity'] = DB::table('stock_moves')->select(DB::raw('SUM(quantity) as total_item'))->first();
        $row_per_page = Preference::getAll()->where('category', 'preference')->where('field', 'row_per_page')->first('value')->value;
        $currency = Currency::getDefault();
        return $dataTable->with('row_per_page', $row_per_page)->with('currency', $currency)->render('admin.workType.view', $data);
    }

    public function create()
    {
        $data = ['menu' => 'item', 'page_title' => __('Create Item')];

        $unit = DB::table('item_units')->get();
        $unit_name = array();
        foreach ($unit as $value) {
            $unit_name[$value->id] = $value->name;
        }

        $data['unit_name']    = $unit_name;
        $data['locData']      = Location::getAll();
        $data['taxTypes']     = TaxType::getAll();
        $data['saleTypes']    = DB::table('sale_types')->get();
        $data['categoryData'] = StockCategory::where('is_active', 1)->get();
        $data['unitData']     = DB::table('item_units')->get();

        return view('admin.workType.add', $data);
    }

}

