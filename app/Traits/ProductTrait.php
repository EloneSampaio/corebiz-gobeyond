<?php

namespace App\Traits;

use App\Http\Resources\ProductResource;
use App\Models\ProductModel;
use App\Services\RedisService;
use Illuminate\Support\Facades\Validator;

trait ProductTrait
{
    use RedisService;

    public function CreateProductsTrait($product) : array
    {


        try {



            $productId = ProductModel::find($product['productId']);

            if(!empty($productId)){

              return   $this->ListagemDeProductByIdTrait($productId->productId);
            }

            $resource = ProductModel::create([
                'productId' => $product['productId'],
                'productName' => $product['productName'],
                'brand' => $product['brand']
            ]);
            return $resource;

        }catch(\Exception $e) {
            return [
                'status' => 500,
                'msg' => $e->getMessage(),
                'data' => []
            ];
        }

        return [
            'status' => 201,
            'data' => $resource
        ];
    }

    public function ListagemDeProductsTrait(object $request) : array
    {

        $expiresAt = now()->addMinutes(1);

        if(isset($request->filter_brand)){
            $list = ProductModel::where(['brand' => $request->filter_brand])->get();
        } else {



            $cache = $this->getCacheById("_products_listagem");

            if(is_array($cache)){
                if($cache['status'] == 404){
                    $list = ProductModel::all()->toArray();
                    $this->setCacheTrait(json_encode($list), "_products_listagem", $expiresAt);
                } else {
                    $list = $cache;
                }
            } else {
                $list = json_decode($cache, true);
            }




        }

        return [
            'status' => 200,
            'data' => ProductResource::collection($list)->values(),
        ];
    }

    public function ListagemDeProductByIdTrait(int $id) : array
    {

        $resource = ProductModel::where(['productId' => $id])->get();

        return [
            'status' => 200,
            'data' => $resource
        ];
    }

}
