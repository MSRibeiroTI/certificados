<?php

namespace App\Models;

class Conn{
    private string $db = "mysql";
    private string $host = "localhost";
    private string $user = "root";
    private string $password = "marcelo81";
    private string $database = "siscert";
    public object $connect;

    public function __construct(){
        $this->connect = $this->connect();
    }

    /**
     * Connect to the database
     *
     * @return \PDO
     * @throws \PDOException
     */
    public function connect(){
        
        try{
            $this->connect = new \PDO(
                "{$this->db}:host={$this->host};dbname={$this->database}",
                $this->user,
                $this->password  
            );
            return $this->connect;
        }
        catch(\PDOException $e){
            $e->getMessage();
            die('Erro: Por favor tente novamente. Banco não conectado, entre em contato com o administrador.');
        }
        
    }
}