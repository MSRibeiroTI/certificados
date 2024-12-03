<?php

namespace App\Views;

session_start();
include("./includes/session.php");

if (!isset($_SESSION['nome'])) {
    header('Location: /certificados');
    exit;
}

require_once '../Controlers/CursoController.php';
require_once '../Controlers/log.php';

use App\Controlers\Log;

$log = Log::getInstance();

use App\Controlers\CursoController;
use Exception;


$cursoController = new CursoController();

if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $cursoController->deletar($id);
    $log->info('Curso deletado com sucesso. ID: ' . $id);
    header('Location: cursos');
    exit();
}

if (isset($_POST['cadastrar'])) {

    $nome = $_POST['Nome'];
    $ch = $_POST['CH'];
    $ies = $_POST['IES'];
    $parecer = $_POST['Parecer'];
    $parecer_curso = $_POST['Parecer_curso'];
    $modalidade = $_POST['Modalidade'];

    $curso = new CursoController();

    try {
        $curso->inserir($nome, $ch, $ies, $parecer, $parecer_curso, $modalidade);
    } catch (Exception $e) {
        $log->info('Erro ao cadastrar curso. Erro: ' . $e->getMessage());
        echo "<script>alert('" . $e->getMessage() . "');</script>";
        echo "<script>window.location.href='cursos';</script>";
        exit();
    }

    $log->info('Curso adicionado com sucesso. Nome: ' . $nome);

    echo "<script>alert('Curso adicionado com sucesso!');</script>";

    header("Location: cursos");
}
$itensPorPagina = 5;
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$offset = ($paginaAtual - 1) * $itensPorPagina;

include "../Views/includes/header.php";

?>
<main>
    <div class="container">
        <div class="title">
            <h3>Cursos</h3>
            <div class="btn-alinhamento">
                <div class="col-md-5">

                    <button class="btn" id="btn-cadastro"> Novo Curso</button>

                </div>
                <div class="col-md-5">
                    <a href="home">
                        <button class="btn">Voltar</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CH</th>
                            <th>IES</th>
                            <th>Parecer</th>
                            <th>Parecer do Curso</th>
                            <th>Modalidade</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cursos = $cursoController->listar($offset, $itensPorPagina);

                        foreach ($cursos as $curso) {
                        ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars($curso['name']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($curso['c_horaria']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($curso['IES']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($curso['parecer']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($curso['parecer_curso']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($curso['tipo_curso']) ?>
                                </td>
                                <td>
                                    <a href="disciplinas?curso=<?= $curso['id_curso'] ?>"><button class="btn">Disciplinas</button></a>
                                    <a href="editar_curso?_xasda_sda=<?= $curso['id_curso'] ?>"><button class="btn">Editar</button></a>
                                    <?php if ($_SESSION['perfil'] == 2): ?>
                                        <a href="javascript:;" data-id="<?= $curso['id_curso'] ?>" class="delete">
                                            <button class="btn">Excluir</button>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <h5>Total de Cursos: <?php echo count($cursos); ?> de <?php echo count($cursoController->listarTodos()); ?></h5>

        </div>
        <?php
        $totalCursos = count($cursoController->listarTodos());
        $totalPaginas = ceil($totalCursos / $itensPorPagina);
        $MaxLinks = 2;
        ?>

        <div class="pages" style="display: flex; flex-direction: row; gap: 10px; align-items: center; justify-content: center; margin-bottom: 20px;">
            Páginas: <br> <a href="?pagina=1">
                << </a>

                    <?php for ($i = $paginaAtual - $MaxLinks; $i <= $paginaAtual - 1; $i++) : ?>
                        <?php if ($i > 0) : ?>
                            <a href="?pagina=<?php echo $i; ?>" onclick=""><?php echo $i; ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php echo $paginaAtual; ?>

                    <?php for ($i2 = $paginaAtual + 1; $i2 <= $paginaAtual + $MaxLinks; $i2++) : ?>
                        <?php if ($i2 <= $totalPaginas) : ?>
                            <a href="?pagina=<?php echo $i2; ?>"><?php echo $i2; ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <a href="?pagina=<?php echo $totalPaginas; ?>"> >></a>


        </div>
        <dialog id="editarCurso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Cadastrar Curso</h3>
                    </div>
                    <form class="curso" action="" method="post">
                        <div class="cad-curso">
                            <div class="curso-nome">
                                <div>
                                    <label for="Nome">Nome:</label><br>
                                    <input type="text" class="nome-curso" name="Nome" id="Nome-curso" placeholder="Nome" autofocus required><br>
                                </div>
                            </div>
                            <div class="curso-ies">
                                <div>
                                    <label for="CH">Carga Horária:</label><br>
                                    <input type="text" name="CH" id="CH" placeholder="Ex.: 540" required><br>
                                </div>
                                <div>
                                    <label for="IES">Faculdade:</label><br>
                                    <Select name="IES">
                                        <option value="">Selecione</option>
                                        <option value="Centro de Ensino Superior de Arcoverde">Centro de Ensino Superior de Arcoverde</option>
                                        <option value="Escola Superior de Saúde de Arcoverde">Escola Superior de Saúde de Arcoverde</option>
                                    </Select><br>
                                </div>
                                <div>
                                    <label for="Parecer">Parecer:</label><br>
                                    <input type="text" name="Parecer" id="Parecer" placeholder="Ex.: CEE/PE nº 167/2012" required><br>
                                </div>
                            </div>
                            <div class="curso-parecer">
                                <div>
                                    <label for="Parecer_curso">Parecer do Curso:</label><br>
                                    <input type="text" name="Parecer_curso" id="Parecer_curso" placeholder="CEE/PE nº 86/2014" required><br>
                                </div>
                                <div>
                                    <label for="Modalidade">Modalidade:</label><br>
                                    <Select name="Modalidade" id="modalidade">
                                        <option value="">Selecione</option>
                                        <option value="Pós-Graduação Lato Sensu">Pós-Graduação Lato Sensu</option>
                                        <option value="Pós-Graduação Stricto Sensu">Pós-Graduação Stricto Sensu</option>
                                        <option value="Pós-Graduação MBA">Pós-Graduação MBA</option>
                                    </Select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <button class="btn" type="submit" name="cadastrar">Cadastrar</button>
                        </div>
                    </form>
                    <div class="col-md-5">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </dialog>
</main>

<?php include "../Views/includes/footer.php"; ?>

<script>
    $(document).ready(function() {
        $('.delete').click(function() {
            var id = $(this).data('id');
            if (confirm("Está certo disto?")) {
                window.location.href = "cursos.php?delete=" + id;
            }
        });

    });


    const button = document.querySelector("#btn-cadastro")

    button.addEventListener("click", () => {
        const dialog = document.querySelector("dialog")
        dialog.showModal()
    })

    const close = document.querySelector(".close")

    close.addEventListener("click", () => {
        const dialog = document.querySelector("dialog")
        dialog.close()
    })
</script>