<?php

namespace Core;

class ConfigController{
    private string $url;

    public function __construct(){
        if(!empty(filter_input(INPUT_GET, "url", FILTER_DEFAULT))){
            $this->url = filter_input(INPUT_GET, "url", FILTER_DEFAULT);
        }
        else{
            $this->url = "index";
        }
    }

    public function carregar(){
        if(file_exists("./app/Views/{$this->url}")){
            return "{$this->url}";
        }else{
            header("Location: ./index");
            exit;
        }

    }
  
}


