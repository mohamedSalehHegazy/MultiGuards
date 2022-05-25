<?php 
namespace App\Http\Controllers\User\Web;

use App\Http\Controllers\User\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{
    public $path = 'products';

    /**
    * Get All Records
    * @return \Illuminate\Http\JsonResponse
    */
    public function index(Request $request)
    {
        try {
            $baseController = new BaseController;
            $records = $baseController->list(Model::class ,$request)
            ->with('category')->get();
            $categories = Category::onlyActive()->latest('created_at')->get();
            return view('user.'.$this->path.'.list',compact(['records','categories']));
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.wrong');
        }
    }
}