<?php

namespace App\Models;

require_once '../Models/Conn.php';

use App\Models\Conn;
use Exception;

class aluno extends Conn
{

    private $conn;
    private $id_aluno;
    private $nome_aluno;
    private $nacionalidade;
    private $naturalidade;
    private $pai;
    private $mae;
    private $nascimento;
    private $rg;
    private $emissor;
    private $graduacao;

    public function __construct(Conn $conn)
    {
        $this->conn = $conn;
    }

    public function getId_aluno()
    {
        return $this->id_aluno;
    }

    public function getNome_aluno()
    {
        return $this->nome_aluno;
    }

    public function getNacionalidade()
    {
        return $this->nacionalidade;
    }

    public function getNaturalidade()
    {
        return $this->naturalidade;
    }

    public function getPai()
    {
        return $this->pai;
    }

    public function getMae()
    {
        return $this->mae;
    }

    public function getNascimento()
    {
        return $this->nascimento;
    }

    public function getRg()
    {
        return $this->rg;
    }

    public function getEmissor()
    {
        return $this->emissor;
    }

    public function getGraduacao()
    {
        return $this->graduacao;
    }

    public function setId_aluno($id_aluno)
    {
        $this->id_aluno = $id_aluno;
    }

    public function setNome_aluno($nome_aluno)
    {
        $this->nome_aluno = $nome_aluno;
    }

    public function setNacionalidade($nacionalidade)
    {
        $this->nacionalidade = $nacionalidade;
    }

    public function setNaturalidade($naturalidade)
    {
        $this->naturalidade = $naturalidade;
    }

    public function setPai($pai)
    {
        $this->pai = $pai;
    }

    public function setMae($mae)
    {
        $this->mae = $mae;
    }

    public function setNascimento($nascimento)
    {
        $this->nascimento = $nascimento;
    }

    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    public function setEmissor($emissor)
    {
        $this->emissor = $emissor;
    }


    public function setGraduacao($graduacao)
    {
        $this->graduacao = $graduacao;
    }

    /**
     * Cadastra um aluno.
     *
     * @param string $nome Nome do aluno.
     * @param string $nacionalidade Nacionalidade do aluno.
     * @param string $naturalidade Naturalidade do aluno.
     * @param string $pai Nome do pai do aluno.
     * @param string $mae Nome da mae do aluno.
     * @param string $nascimento Data de nascimento do aluno no formato YYYY-mm-dd.
     * @param string $rg RG do aluno.
     * @param string $emissor Emissor do RG.
     * @param string $graduacao Graduacao do aluno.
     *
     * @throws \Exception Se algum dos argumentos forem vazios ou inválidos.
     *
     * @return boolean True se o aluno for cadastrado com sucesso.
     */
    public function inserir($nome, $nacionalidade, $naturalidade, $pai, $mae, $nascimento, $rg, $emissor, $graduacao)
    {

        if (empty($nome) || strlen($nome) < 3)
            throw new Exception('Nome inválido!');
        else
            $this->nome_aluno = $nome;
        
        $emissor = strtoupper($emissor);

        if (empty($rg) || strlen($rg) < 7)
            throw new Exception('RG inválido!');
        else
            $this->rg = $rg;
        try {
            $stmt = $this->conn->connect->prepare(
                'INSERT INTO aluno VALUES (null, :nome_aluno, :nacionalidade, :naturalidade, :pai, :mae, :nascimento, :rg, :graduacao, :emissor)'
            );
            $stmt->execute([
                'nome_aluno' => $nome,
                'nacionalidade' => $nacionalidade,
                'naturalidade' => $naturalidade,
                'pai' => $pai,
                'mae' => $mae,
                'nascimento' => $nascimento,
                'rg' => $rg,
                'graduacao' => $graduacao,
                'emissor' => $emissor
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function listarTodos()
    {

        $stmt = $this->conn->connect->prepare('SELECT * FROM aluno order by name ASC');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deletar($id)
    {
        $stmt = $this->conn->connect->prepare('DELETE FROM aluno WHERE id_aluno = :id');
        $stmt->execute(['id' => $id]);
    }

    public function listarCert($id)
    {
        $stmt = $this->conn->connect->prepare('SELECT * FROM aluno where id_aluno = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Realiza uma busca por um aluno com base na chave informada.
     *
     * @param string $key Chave de busca.
     * @param int $offset Número da página a ser retornada.
     * @param int $itensPorPagina Número de itens por página.
     * @return array Um array com os dados do aluno encontrado.
     */
    public function searchAluno($key, $offset, $itensPorPagina)
    {
        if (empty($key)) {
            $sql = "SELECT * FROM aluno order by name ASC LIMIT $offset, $itensPorPagina";
            $stmt = $this->conn->connect->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }else{
                    
        $stmt = $this->conn->connect->prepare("SELECT * FROM aluno WHERE name LIKE :key order by name ASC");

        $stmt->execute(['key' => "%$key%"]);

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $result;
    }

    /**
     * Atualiza um aluno com os dados fornecidos.
     *
     * @param int $id ID do aluno a ser atualizado.
     * @param string $nome Nome do aluno.
     * @param string $nacionalidade Nacionalidade do aluno.
     * @param string $naturalidade Naturalidade do aluno.
     * @param string $pai Pai do aluno.
     * @param string $mae Mae do aluno.
     * @param string $nascimento Data de nascimento do aluno.
     * @param string $rg RG do aluno.
     * @param string $emissor Emissor do RG do aluno.
     * @param string $graduacao Graduacao do aluno.
     *
     * @return bool Retorna TRUE caso a atualizacao seja realizada com sucesso.
     *
     * @throws Exception Caso haja algum erro durante a atualizacao.
     */
    public function update($id, $nome, $nacionalidade, $naturalidade, $pai, $mae, $nascimento, $rg, $emissor, $graduacao)
    {

        if (empty($nome) || strlen($nome) < 3)
            throw new Exception('Nome inválido!');
        else
            $this->nome_aluno = $nome;

        $emissor = strtoupper($emissor);

        if (empty($rg) || strlen($rg) < 5)
            throw new Exception('RG inválido!');
        else
            $this->rg = $rg;

        try {
            $stmt = $this->conn->connect->prepare('UPDATE aluno SET name = :name
            , nacionalidade = :nacionalidade
            , naturalidade = :naturalidade
            , pai = :pai
            , mae = :mae
            , nascimento = :nascimento
            , rg = :rg
            , emissor = :emissor
            , graduacao = :graduacao
            WHERE id_aluno = :id');
            $stmt->execute([
                'name' => $nome,
                'nacionalidade' => $nacionalidade,
                'naturalidade' => $naturalidade,
                'pai' => $pai,
                'mae' => $mae,
                'nascimento' => $nascimento,
                'rg' => $rg,
                'emissor' => $emissor,
                'graduacao' => $graduacao,
                'id' => $id
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
