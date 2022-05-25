<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCreateRequest  as CreateRequest;
use App\Models\Category ;
use App\Models\Product as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{
    public $path = 'products';
    public $item_per_page = 10;
    /**
    * Get All Records
    * @return \Illuminate\Http\JsonResponse
    */

    public function index()
    {
        try {
            $records = Model::with('category')->latest()->paginate($this->item_per_page);
            return view('admin.'.$this->path.'.list',compact('records'));
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.wrong');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereActive(true)->get();
        return view('admin.'.$this->path.'.add-edit',compact(['categories']));
    }

    /**
    * Create a New Record
    * @param CreateRequest $request
    * @return \Illuminate\Http\JsonResponse
    */

    public function store(CreateRequest $request)
    {
        try {
            Model::create($request->all());
            return redirect('admin/'.$this->path)->with('success','Created Successfully');
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.wrong');
        }
    }

}