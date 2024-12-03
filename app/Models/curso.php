<?php

namespace App\Models;

require_once '../Models/Conn.php';

use App\Models\Conn;
use Exception;

class curso extends Conn{

    private $conn;

    public function __construct(Conn $conn){
        $this->conn = $conn;
    }

    /**
     * Insere um novo curso na base de dados
     *
     * @param string $nome Nome do curso
     * @param int $ch Carga hor ria do curso
     * @param string $ies IES que oferece o curso
     * @param string $parecer Parecer do curso
     * @param string $parecer_curso Parecer do curso referente ao Parecer
     * @param string $tipo Tipo do curso
     *
     * @throws Exception Caso ocorra algum erro durante a execu o da query
     *
     * @return void
     */
    public function inserir($nome, $ch, $ies, $parecer, $parecer_curso, $tipo){
        try{
        $sql = "INSERT INTO `curso` (`name`, `c_horaria`, `IES`, `parecer`, `parecer_curso`, `tipo_curso`) 
        VALUES (:nome, :ch, :ies, :parecer, :parecer_curso, :tipo)";
        $stmt = $this->conn->connect->prepare($sql);
        $stmt->execute([
            'nome' => $nome,
            'ch' => $ch,
            'ies' => $ies,
            'parecer' => $parecer,
            'parecer_curso' => $parecer_curso,
            'tipo' => $tipo
        ]);
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Busca os cursos na base de dados.
     *
     * @param int $offset Offset para pagina o de resultados.
     * @param int $itensPorPagina N mero de itens por p gina.
     *
     * @return array Retorna um array com os dados dos cursos.
     */

    public function listar($offset, $itensPorPagina){

        $sql = "SELECT * FROM `curso` order by name ASC LIMIT $offset, $itensPorPagina";
        $stmt = $this->conn->connect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
    }

    /**
     * Retorna todos os cursos da base de dados
     *
     * @return array Todos os cursos
     */
    public function listarTodos()
    {

        $sql = "SELECT * FROM `curso`";
        $stmt = $this->conn->connect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deletar($id){

        $sql = "DELETE FROM `curso` WHERE id_curso = :id";
        $stmt = $this->conn->connect->prepare($sql);
        $stmt->execute(['id' => $id]);

    }

    /**
     * Busca um curso na base de dados pelo seu ID.
     *
     * @param int $id Identificador único do curso a ser buscado.
     *
     * @throws Exception Caso ocorra algum erro durante a execu o da query
     *
     * @return array|null Retorna um array com os dados do curso caso ele
     *                   seja encontrado ou null caso n o seja encontrado.
     */
    public function listarDados($id){

        $sql = "SELECT * FROM `curso` WHERE id_curso = :id";
        $stmt = $this->conn->connect->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }

    /**
     * Atualiza um curso existente na base de dados com os novos dados fornecidos.
     *
     * @param int $id Identificador único do curso a ser atualizado.
     * @param string $nome Novo nome do curso.
     * @param int $ch Nova carga horária do curso.
     * @param string $ies Nova IES que oferece o curso.
     * @param string $parecer Novo parecer do curso.
     * @param string $parecer_curso Novo parecer do curso referente ao parecer.
     * @param string $tipo Novo tipo do curso.
     *
     * @return void
     */
    public function alterar($id, $nome, $ch, $ies, $parecer, $parecer_curso, $tipo){

        $sql = "UPDATE `curso` SET `name` = :nome, `c_horaria` = :ch, `IES` = :ies, `parecer` = :parecer, `parecer_curso` = :parecer_curso, `tipo_curso` = :tipo WHERE `id_curso` = :id";

        $stmt = $this->conn->connect->prepare($sql);

        $stmt->execute([
            'id' => $id,
            'nome' => $nome,
            'ch' => $ch,
            'ies' => $ies,
            'parecer' => $parecer,
            'parecer_curso' => $parecer_curso,
            'tipo' => $tipo
        ]);

    }
}