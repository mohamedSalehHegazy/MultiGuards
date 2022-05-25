<?php 
namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\User\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Product as Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\User\ProductListResource  as ListResource;

class ProductsController extends Controller
{
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
            return response()->json([
                'success' => true,
                'data' => ListResource::collection($records)
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                'message' => 'Some Thing Went Wrong !'
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}