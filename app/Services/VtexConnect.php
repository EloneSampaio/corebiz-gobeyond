<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Services\RedisService;


//? Classe de conexão, apenas conecta.
trait VtexConnect {

    use RedisService;

    public function connectGet($url)
    {
        $key = 'meuEndpoint_'.$url;
        $ttl = 60;


      $data = $this->getCacheById($key);

      if(is_array($data)){
      if($data['status'] == 404){
        $result = Http::accept('application/json')->get($url)->collect();
        $this->setCacheTrait(json_encode($result,true), $key, $ttl);
        return (object) $result;
      }
      }else {

        return $data;
      }


}


}




