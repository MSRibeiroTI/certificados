<?php

namespace App\Controlers;

use App\Models\Conn;
use App\Models\professor;

require_once '../Models/Conn.php';
require_once '../Models/professor.php';

class ProfessorController{

    private $professor;

    public function __construct(){
        $conn = new Conn();
        $this->professor = new professor($conn);
    }

    /**
     * Inserir um novo professor no banco de dados.
     *
     * @param string $nome Nome do professor.
     * @param string $titulo Titulo do professor.
     *
     * @return void
     */
    public function inserir($nome, $titulo){
        return $this->professor->inserir($nome, $titulo);
    }

    public function deletar($id){
        return $this->professor->deletar($id);

    }

    /**
     * Alterar um professor existente no banco de dados.
     *
     * @param string $name Novo nome do professor.
     * @param string $titulo Novo título do professor.
     * @param int $id ID do professor.
     *
     * @throws \Exception Se o nome, título ou ID forem inválidos.
     *
     * @return void
     */
    public function alterar($name, $titulo, $id){
        if(empty($name) || strlen($name) < 5){
            throw new \Exception("Nome do professor inválido");
        }

        if(empty($titulo) || strlen($titulo) < 3){
            throw new \Exception("Título do professor inválido");
        }

        if(!is_numeric($id) || $id <= 0){
            throw new \Exception("ID do professor inválido");
        }

        return $this->professor->update($name, $titulo, $id);
        
   }

    /**
     * Retorna um array com todos os professores presentes no banco de dados.
     *
     * @return array Um array com os professores.
     */
    public function listar(){
        return $this->professor->listar();
    }

    public function dados($id){
        return $this->professor->dados($id);
    }

 
}