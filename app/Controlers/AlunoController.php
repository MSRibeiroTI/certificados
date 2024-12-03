<?php

namespace App\Controlers;

use App\Models\Conn;
use App\Models\aluno;

require_once '../Models/Conn.php';
require_once '../Models/aluno.php';

class AlunoController
{

    private $aluno;

    /**
     * Construtor da classe AlunoController.
     *
     * Instancia um objeto do tipo Conn e o passa como par metro para o construtor
     * da classe Aluno.
     */
    public function __construct()
    {
        $conn = new Conn();
        $this->aluno = new Aluno($conn);
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
        //valida o nome
        if (empty($nome) || !preg_match('/^[\p{L}\s]+$/ui', $nome)) {
            throw new \Exception("Nome inválido");
        }
        //valida nacionalidade
        if (empty($nacionalidade) || !preg_match('/^[\p{L}\s]+$/ui', $nacionalidade)) {
            throw new \Exception("Nacionalidade inválida");
        }

        //valida pai
        if (empty($pai) || !preg_match('/^[\p{L}\s]+$/ui', $pai)) {
            throw new \Exception("Pai inválido");
        }
        //valida mae
        if (empty($mae) || !preg_match('/^[\p{L}\s]+$/ui', $mae)) {
            throw new \Exception("Mae inválida");
        }
        //valida nascimento
        if (empty($nascimento) || !preg_match('/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/', $nascimento)) {
            throw new \Exception("Data de nascimento inválida. O formato deve ser: YYYY-mm-dd");
        }

        //valida graduacao
        if (empty($graduacao) || !preg_match('/^[\p{L}\s]+$/ui', $graduacao)) {
            throw new \Exception("Graduac o inválida");
        }
        // Filtro contra ataque XSS (Cross-Site Scripting)
        htmlspecialchars($nome);
        htmlspecialchars($nacionalidade);
        htmlspecialchars($naturalidade);
        htmlspecialchars($pai);
        htmlspecialchars($mae);
        htmlspecialchars($rg);
        htmlspecialchars($emissor);
        htmlspecialchars($graduacao);
        htmlspecialchars($nascimento);

        return $this->aluno->inserir($nome, $nacionalidade, $naturalidade, $pai, $mae, $nascimento, $rg, $emissor, $graduacao);
    }

    /**
     * Lista todos os alunos.
     * 
     * @return array Lista de todos os alunos.
     */
    public function listar()
    {
        return $this->aluno->listarTodos();
    }
    /**
     * Lista todos os alunos.
     * 
     * @return array Lista de todos os alunos.
     */
    public function listarTodos()
    {
        return $this->aluno->listarTodos();
    }

    /**
     * Deleta um aluno.
     * 
     * @param int $id ID do aluno a ser deletado.
     * 
     * @return bool True se o aluno for deletado com sucesso, False caso contrário.
     */
    public function deletar($id)
    {
        return $this->aluno->deletar($id);
    }

    /**
     * Lista todos os certificados de um aluno.
     * 
     * @param int $id ID do aluno.
     * 
     * @return array Retorna um array com todos os certificados do aluno.
     */
    public function listarCert($id)
    {

        return $this->aluno->listarCert($id);
    }

    /**
     * Procura por um aluno com base na chave informada.
     *
     * @param string $key Chave de busca.
     * @param int $offset Número da página a ser retornada.
     * @param int $itensPorPagina Número de itens por página.
     * @return array Um array com os dados do aluno encontrado.
     */
    public function searchAluno($key, $offset, $itensPorPagina)
    {
        htmlspecialchars($key);
        return $this->aluno->searchAluno($key, $offset, $itensPorPagina);
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
        htmlspecialchars($nome);
        htmlspecialchars($nacionalidade);
        htmlspecialchars($naturalidade);
        htmlspecialchars($pai);
        htmlspecialchars($mae);
        htmlspecialchars($rg);
        htmlspecialchars($emissor);
        htmlspecialchars($graduacao);
        htmlspecialchars($nascimento);

        return $this->aluno->update($id, $nome, $nacionalidade, $naturalidade, $pai, $mae, $nascimento, $rg, $emissor, $graduacao);
    }
}
