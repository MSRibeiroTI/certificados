<?php

namespace App\Controlers;

use App\Models\Conn;
use App\Models\curso;

require_once '../Models/Conn.php';
require_once '../Models/curso.php';

class CursoController
{

    private $curso;

    public function __construct()
    {
        $conn = new Conn();
        $this->curso = new curso($conn);
    }

    /**
     * Cadastra um novo curso
     *
     * @param string $nome        Nome do curso
     * @param string $ch          Carga horária
     * @param string $ies         Faculdade
     * @param string $parecer     Parecer
     * @param string $parecer_curso Parecer do curso
     * @param string $tipo        Modalidade do curso
     *
     * @return bool
     */
    public function inserir($nome, $ch, $ies, $parecer, $parecer_curso, $tipo)
    {
        htmlspecialchars($nome);
        htmlspecialchars($ch);
        htmlspecialchars($ies);
        htmlspecialchars($parecer);
        htmlspecialchars($parecer_curso);
        htmlspecialchars($tipo);
        return $this->curso->inserir($nome, $ch, $ies, $parecer, $parecer_curso, $tipo);
    }

    public function listar($offset, $itensPorPagina)
    {

        return $this->curso->listar($offset, $itensPorPagina);
    }

    public function listarTodos()
    {
        return $this->curso->listarTodos();
    }

    public function dados($id)
    {

        return $this->curso->listarDados($id);
    }

    public function deletar($id)
    {

        return $this->curso->deletar($id);
    }

    public function alterar($id, $nome, $ch, $ies, $parecer, $parecer_curso, $tipo)
    {
        htmlspecialchars($nome);
        htmlspecialchars($ch);
        htmlspecialchars($ies);
        htmlspecialchars($parecer);
        htmlspecialchars($parecer_curso);
        htmlspecialchars($tipo);
        return $this->curso->alterar($id, $nome, $ch, $ies, $parecer, $parecer_curso, $tipo);
    }
}
