<?php

namespace App\Models;

require_once '../Models/Conn.php';

use App\Models\Conn;
use Exception;

class professor extends Conn{

    private $conn;
    

    public function __construct(Conn $conn){
        $this->conn = $conn;
    }

    /**
     * Retorna todos os professores da base de dados
     * 
     * @return array Todos os professores
     */
    public function listar(){
        $stmt = $this->conn->connect->prepare('SELECT * FROM professor order by name ASC');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

    /**
     * Deleta um professor da base de dados pelo seu ID.
     *
     * @param int $id Identificador único do professor a ser deletado.
     *
     * @return void
     */
    public function deletar($id){
        $stmt = $this->conn->connect->prepare('DELETE FROM professor WHERE id_professor = :id');
        $stmt->execute([
            'id' => $id
        ]);
    }

    /**
     * Insere um novo professor na base de dados.
     * 
     * @param string $nome Nome do professor.
     * @param string $titulo Titulo do professor.
     * 
     * @return void
     */
    public function inserir($nome, $titulo){
        $stmt = $this->conn->connect->prepare('INSERT INTO professor VALUES (null, :nome, :titulo)');
        $stmt->execute([
            'nome' => $nome,
            'titulo' => $titulo
        ]);
    }

    /**
     * Retorna os dados de um professor a partir do seu ID.
     * 
     * @param int $id Identificador único do professor a ser retornado.
     * 
     * @return array Os dados do professor.
     */
    public function dados($id){
        $stmt = $this->conn->connect->prepare('SELECT * FROM professor WHERE id_professor = :id');
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Altera os dados de um professor existente na base de dados.
     * 
     * @param string $name Novo nome do professor.
     * @param string $titulo Novo título do professor.
     * @param int $id ID do professor a ser alterado.
     * 
     * @return void
     */
    public function update($name, $titulo, $id){
        $stmt = $this->conn->connect->prepare('UPDATE professor SET name = :name, titulo = :titulo WHERE id_professor = :id');
        $stmt->execute([
            'name' => $name,
            'titulo' => $titulo,
            'id' => $id
        ]);
    }
}