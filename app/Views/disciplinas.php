<?php

namespace App\Views;

session_start();
include("./includes/session.php");

if (!isset($_SESSION['nome'])) {
    header('Location: /certificados');
    exit();
}

require_once '../Controlers/DisciplinaController.php';
require_once '../Controlers/CursoController.php';
require_once '../Controlers/log.php';

use App\Controlers\Log;

$log = Log::getInstance();

use App\Controlers\DisciplinaController;
use App\Controlers\CursoController;
use Exception;

$disciplinaController = new DisciplinaController();
$dados = new CursoController();

if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $disciplinaController->deletar($id);
    $log->info('Disciplina deletada com sucesso. ID: ' . $id);
    header('Location: disciplinas?curso=' . $_GET['curso']);
    exit();
}

if (isset($_POST['disciplina'])) {

    $nome = $_POST['nomeDisciplina'];
    $ch = $_POST['cargaHoraria'];
    $id_curso = $_POST['curso'];
    $ativo = $_POST['ativo'];
    try {
        $disciplinaController->inserir($nome, $ch, $id_curso, $ativo);
    } catch (Exception $e) {
        $log->info($e->getMessage());
        echo "<script>alert('" . $e->getMessage() . "');</script>";
        echo "<script>window.location.href='disciplinas?curso=" . $_POST['curso'] . "';</script>";
        exit;
    }
    $log->info('Disciplina inserida com sucesso. Nome: ' . $nome);
    header('Location: disciplinas?curso=' . $_POST['curso']);
    exit();
}

if (isset($_GET['ativar']) && isset($_GET['curso']) ) {
    $curso = $_GET['curso'];
    $disciplinaController->alterarAtivo($_GET['ativar'], '1');
    $log->info('Disciplina ativada com sucesso. ID: ' . $_GET['ativar']);
    header('Location: disciplinas?curso=' . $curso);
    exit();
} elseif (isset($_GET['desativar']) && isset($_GET['curso'])) {
    $curso = $_GET['curso'];
    $disciplinaController->alterarAtivo($_GET['desativar'], '0');
    $log->info('Disciplina desativada com sucesso. ID: ' . $_GET['desativar']);
    header('Location: disciplinas?curso=' . $curso);
    exit();
}

include "../Views/includes/header.php";
?>
<!-- lista todas as disciplinas cadastradas -->
<main>
    <div class="container">
        <div class="title">
            <?php $dados = $dados->dados($_GET['curso'] ?? ''); ?>
            <h2>Curso: <?php echo $dados['name'] ?></h2>
            <div class="btn-alinhamento">
                <div class="col-md-5">
                    <button class="btn" data-toggle="modal" data-target="#cadastrarDisciplina">Nova Disciplina</button>
                </div>

                <div class="col-md-5">
                    <a href="cursos">
                        <button class="btn">Voltar</button>
                    </a>
                </div>
            </div>

        </div>

        <div class="row-justify-content-center">
            <div class="col-md-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Carga Horária</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $dados = $disciplinaController->listar($_GET['curso']);

                        foreach ($dados as $disciplina) {

                        ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars($disciplina['name']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($disciplina['c_h']) ?>
                                </td>
                                <td>
                                    <?php if ($disciplina['ativo'] == 1) { ?>
                                        <a href="disciplinas?desativar=<?= $disciplina['id_disciplina'] ?>&curso=<?= $_GET['curso'] ?>"><button class="btn" style="background-color: green;">Ativo</button></a>
                                    <?php } else { ?>
                                        <a href="disciplinas?ativar=<?= $disciplina['id_disciplina'] ?>&curso=<?= $_GET['curso'] ?>"><button class="btn" style="background: red;">Inativo</button></a>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="editar_disciplina?id=<?= $disciplina['id_disciplina'] ?>&_curso=<?= $_GET['curso'] ?>">
                                        <button class="btn">Editar</button>
                                    </a>
                                    <?php if ($_SESSION['perfil'] == 2) { ?>

                                        <a href="javascript:;" data-id="<?= $disciplina['id_disciplina'] ?>" class="delete">
                                            <button class="btn">Excluir</button>

                                        <?php } ?>
                                </td>
                            </tr>

                        <?php

                        }

                        ?>

                    </tbody>
                    <br><br>
                </table>
            </div>
        </div>

        <!-- Modal de cadastro de disciplina -->
        <dialog class="dialog">
            <div class="modal fade" id="cadastrarDisciplina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cadastrar Disciplina</h5>

                        </div>
                        <div class="modal-body">
                            <form action="" method="post" id="form">
                                <div class="form-group"><br>
                                    <label for="nomeDisciplina">Nome da Disciplina</label><br>
                                    <input type="text" class="form-control" id="nomeDisciplina" name="nomeDisciplina" placeholder="Informe o nome da disciplina" required>
                                </div>
                                <div class="form-group"><br>
                                    <label for="cargaHoraria">Carga Horária</label><br>
                                    <input type="number" class="form-control" id="cargaHoraria" name="cargaHoraria" placeholder="Informe a carga horária" required>
                                </div>
                                <input type="hidden" name="curso" value="<?php echo $_GET['curso'] ?? ''; ?>">
                                <input type="hidden" name="ativo" value="1">
                                <div class="col-md-5">
                                    <button type="submit" name="disciplina" class="btn">Cadastrar</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-5">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </dialog>

    </div>
</main>

<?php include "../Views/includes/footer.php"; ?>
<script>
    $(document).ready(function() {
        $('.delete').click(function() {
            var id = $(this).data('id');
            if (confirm("Está certo disto?")) {
                window.location.href = "/certificados/app/Views/disciplinas.php?delete=" + id + "&curso=" + <?php echo $_GET['curso'] ?? ''; ?>;
            }
        });

    });

    function saveScrollPosition(){
        localStorage.setItem('scrollPosition', window.scrollY);
    }
    window.addEventListener('beforeunload', saveScrollPosition);

    function restoreScrollPosition(){
        const scrollPosition = localStorage.getItem('scrollPosition');
        if (scrollPosition) {
            window.scrollTo(0, parseInt(scrollPosition, 10));
        }
    }
    window.addEventListener('load', restoreScrollPosition);



    const button = document.querySelector("button")

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