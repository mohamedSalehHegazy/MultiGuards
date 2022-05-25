<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class BaseController extends Controller
{
    public function list($model,$request)
    {
        try {
            $query = $model::onlyActive()->latest('created_at');
            if($request->has('search')){
                $query->where('name_en','LIKE','%'.$request->search.'%')
                ->orWhere('name_ar','LIKE','%'.$request->search.'%');
            }
            if($request->has('category_filter')){
                $query->whereCategoryId($request->category_filter);
            }
            return $query;
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function find()
    {
       
    }


}