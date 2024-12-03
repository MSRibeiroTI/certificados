<?php

namespace Core;

class ConfigView{


    public function redirecionarLogin($url){

        if(!empty($url)){
            return "./app/Views/{$url}";

            exit;
        }
    }

    public function redirecionar($url)
    {

        if (!empty($url)) {
            return "{$url}";

            exit;
        }
    }

    
}