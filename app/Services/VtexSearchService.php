<?php

namespace App\Services;

use App\Traits\ProductTrait;

//? Classe de serviço Search, que utiliza a conexão.
class VtexSearchService {

    use VtexConnect;
    use ProductTrait;

    public function searchServiceVtex($url)
    {

        $result = $this->connectGet($url);
        $result = json_decode($result, true);

    if($result){
          foreach($result as $item){
            $item['productId'] = (int) $item['productId'];

            $data= [
                'productId' => $item['productId'],
                'productName' => $item['productName'],
                'brand' => $item['brand']
            ];
        };



        return $this->CreateProductsTrait($data);

    }
    else{
        return [
            'status' => 200,
            'data' => 'produto não existe'
        ];
    }
    }

}
