<?php

namespace App\Http\Controllers;

use App\Services\VtexSearchService;
use Illuminate\Http\Request;

class ServicesAPIVtexController extends Controller
{

    protected $endpointSearch;

    public function __construct()
    {
        //? Controller API VTEX que utiliza o Service Search, podendo utilizar diversos Services Diferentes.
        $this->endpointSearch = new VtexSearchService();
    }


    public function listagemSearchByIdVtex(Request $request)
    {

        if (env('URL_CHIL')){
           $URL= env('URL_CHIL').$request->productId;
        }

        $result = $this->endpointSearch->searchServiceVtex($URL);

        return $result;
    }



}
