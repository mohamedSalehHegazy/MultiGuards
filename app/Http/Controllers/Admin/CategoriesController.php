<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryCreateRequest  as CreateRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest  as UpdateRequest;
use App\Models\Category  as Model;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoriesController extends Controller
{
    public $path = 'categories';
    public $item_per_page = 10;
    /**
    * Get All Records
    * @return \Illuminate\Http\JsonResponse
    */

    public function index()
    {
        try {
            $records = Model::with('parentCategory')->latest()->paginate($this->item_per_page);
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
        $categories = Model::whereActive(true)->get();
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try {
           $record = Model::with('parentCategory')->find($request->id);
            if ($record){
                $categories = Model::whereActive(true)->get();
                return view('admin/'.$this->path.'.add-edit',compact(['record','categories']));
            }else {
                return redirect('admin/'.$this->path)->with('error','Not Found');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.wrong');
        }
    }

    /**
    * Update Record
    * @param UpdateRequest $request, $id
    * @return \Illuminate\Http\JsonResponse
    */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $record = Model::find($id);
            if ($record){
                $record->update($request->all());
                return redirect('admin/'.$this->path)->with('success','Updated Successfully');
            }else {
                return redirect('admin/'.$this->path)->with('error','Not Found');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.wrong');
        }
    }

    /**
    * Delete Record
    * @param $id
    * @return \Illuminate\Http\JsonResponse
    */
    public function destroy($id)
    {
        try {
            $product = Product::whereCategoryId($id)->pluck('category_id');
            $subCategory = Model::whereParentId($id)->pluck('parent_id');

            if(count($product) > 0 || count($subCategory) > 0 ) {
                return redirect('admin/'.$this->path)->with('success','cant be Deleted ! you should delete related subCategory and serviceProviders at first');
            }
            $record = Model::find($id);
            if ($record){
                $record->delete();
                return redirect('admin/'.$this->path)->with('success','Deleted Successfully');
            }else {
                return redirect('admin/'.$this->path)->with('error','Not Found');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.wrong');
        }
    }

}