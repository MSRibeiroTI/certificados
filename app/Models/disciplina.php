<?php
namespace App\Models;

require_once '../Models/Conn.php';

use App\Models\Conn;
use Exception;

class disciplina extends Conn{

    private $conn;
    private $id_disciplina;
    private $nome_disciplina;
    private $ch;
    private $id_curso;
    private $ativo;

    public function __construct(Conn $conn){
        $this->conn = $conn;
    }

    public function getId_disciplina(){
        return $this->id_disciplina;
    }

    public function getNome_disciplina(){
        return $this->nome_disciplina;
    }

    public function getCh(){
        return $this->ch;
    }

    public function getId_curso(){
        return $this->id_curso;
    }

    public function getAtivo(){
        return $this->ativo;
    }

    public function setId_disciplina($id_disciplina){
        $this->id_disciplina = $id_disciplina;
    }

    public function setNome_disciplina($nome_disciplina){
        $this->nome_disciplina = $nome_disciplina;
    }

    public function setCh($ch){
        $this->ch = $ch;
    }

    public function setId_curso($id_curso){
        $this->id_curso = $id_curso;
    }

    public function setAtivo($ativo){
        $this->ativo = $ativo;
    }

    /**
     * Insere uma disciplina no banco de dados
     *
     * @param string $nome_disciplina nome da disciplina
     * @param int $ch carga hor ria da disciplina
     * @param int $id_curso id do curso no qual a disciplina ser  inserida
     * @param int $ativo status da disciplina no banco de dados (1 = ativo, 0 = inativo)
     *
     * @throws Exception se houver algum erro na execu o da query
     */
    public function inserir($nome_disciplina, $ch, $id_curso, $ativo){
        try{
        $sql = "INSERT INTO `disciplina`(`name`, `c_h`, `id_curso`, `ativo`) VALUES (:nome_disciplina, :ch, :id_curso, :ativo)";
        $stmt = $this->conn->connect->prepare($sql);
        $stmt->execute(['nome_disciplina' => $nome_disciplina, 'ch' => $ch, 'id_curso' => $id_curso, 'ativo' => $ativo]);
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    
    }

    /**
     * Atualiza uma disciplina no banco de dados
     *
     * @param int $id_disciplina ID da disciplina a ser atualizada
     * @param string $nome_disciplina Novo nome da disciplina
     * @param int $ch Nova carga horária da disciplina
     *
     * @throws Exception se houver algum erro na execução da query
     */
    public function atualizar($id_disciplina, $nome_disciplina, $ch){
        $sql = "UPDATE `disciplina` SET name = :nome_disciplina, c_h = :ch WHERE id_disciplina = :id_disciplina";
        $stmt = $this->conn->connect->prepare($sql);
        $stmt->execute(['nome_disciplina' => $nome_disciplina, 'ch' => $ch, 'id_disciplina' => $id_disciplina]);
    }

    /**
     * Deleta uma disciplina do banco de dados
     *
     * @param int $id ID da disciplina a ser deletada
     *
     * @throws Exception se houver algum erro na execu o da query
     */
    public function deletar($id){
        $sql = "DELETE FROM `disciplina` WHERE id_disciplina = :id";
        $stmt = $this->conn->connect->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    /**
     * Retorna todas as disciplinas de um curso
     *
     * @param int $id ID do curso
     *
     * @return array Um array de disciplinas
     */
    public function listarTodos($id){

        $stmt = $this->conn->connect->prepare('SELECT * FROM disciplina WHERE id_curso = ? order by name ASC');
        $stmt->execute([$id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Retorna todas as disciplinas ativas de um curso
     *
     * @param int $id ID do curso
     *
     * @return array Um array de disciplinas ativas
     */
    public function listarAtivos($id){

        $stmt = $this->conn->connect->prepare('SELECT * FROM disciplina WHERE id_curso = ? AND ativo = 1 order by name ASC');
        $stmt->execute([$id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Retorna os dados de uma disciplina específica
     *
     * @param int $id ID da disciplina
     *
     * @return array|false Um array contendo o nome e a carga horária da disciplina ou false se não encontrado
     */
    public function dadosDisciplina($id){

        $stmt = $this->conn->connect->prepare('SELECT name, c_h FROM disciplina WHERE id_disciplina = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
}

    /**
     * Altera o status de ativa o de uma disciplina no banco de dados
     *
     * @param int $id ID da disciplina a ser alterada
     * @param int $ativo Status da disciplina no banco de dados (1 = ativo, 0 = inativo)
     *
     * @throws Exception se houver algum erro na execu o da query
     */
    public function alterarAtivo($id, $ativo){
       
        $sql = "UPDATE `disciplina` SET ativo = :ativo WHERE id_disciplina = :id";
        $stmt = $this->conn->connect->prepare($sql);
        $stmt->execute(['ativo' => $ativo, 'id' => $id]);
    }

}


    