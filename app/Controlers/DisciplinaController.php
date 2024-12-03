<?php

namespace App\Controlers;

use App\Models\Conn;
use App\Models\disciplina;

require_once '../Models/Conn.php';
require_once '../Models/disciplina.php';

class DisciplinaController{

    private $disciplina;

    public function __construct(){
        $conn = new Conn();
        $this->disciplina = new Disciplina($conn);
    }

    public function inserir($nome_disciplina, $ch, $id_curso, $ativo){
        htmlspecialchars($nome_disciplina);
        htmlspecialchars($ch);
        htmlspecialchars($id_curso);
        htmlspecialchars($ativo);
        return $this->disciplina->inserir($nome_disciplina, $ch, $id_curso, $ativo);
    }

    public function listar($id){
        return $this->disciplina->listarTodos($id);

    }

    public function ativos($id){
        return $this->disciplina->listarAtivos($id);
    }

    public function deletar($id){
        return $this->disciplina->deletar($id);

    }
    
    public function atualizar($id, $disciplina, $ch){

        return $this->disciplina->atualizar($id, $disciplina, $ch);

    }

    public function dados($id){
        return $this->disciplina->dadosDisciplina($id);
    }

    public function alterarAtivo($id, $ativo){
       
           return $this->disciplina->alterarAtivo($id, $ativo);
    }

 
}