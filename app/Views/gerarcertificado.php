<?php

namespace App\Views;

session_start();
include("./includes/session.php");
require_once '../Controlers/CertificadoController.php';
require_once '../Controlers/AlunoController.php';
require_once '../Controlers/CursoController.php';
require_once '../Controlers/log.php';

use App\Controlers\Log;

$log = Log::getInstance();

use App\Controlers\CertificadoController;
use App\Controlers\AlunoController;
use App\Controlers\CursoController;

if (!isset($_SESSION['nome'])) {
    header('Location: /certificados');
    exit();
}

if (isset($_POST['iniciar'])) {
    $aluno = $_POST['aluno'];
    $curso = $_POST['curso'];
    header("Location: gerar_certificado?aluno=$aluno&curso=$curso");
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $certificado = new CertificadoController();
    $certificado->deletar($id);
    $log->info('Certificado deletado com sucesso. ID: ' . $id);
    header("Location: gerarcertificado");
    exit();
}

$dados = new CertificadoController();
$aluno = new AlunoController();
$curso = new CursoController();

include "../Views/includes/header.php";

?>

<main>
    <div class="container">
        <div class="title">
            <h3>Gerar Certificado</h3>
            <div class="btn-alinhamento">
                <div class="col-md-5">
                    <button class="btn" data-toggle="modal" data-target="#cadastrarDisciplina">Novo Certificado</button>
                </div>
                <div class="col-md-5">
                    <a href="home"><button class="btn">Voltar</button></a>
                </div>
            </div>
            <div class="search">
                <form action="" class="form_search" method="get" id="form_search">
                    <label class="input_search">
                        <input type="text" id="pesquisa" name="q" placeholder="Aluno ou Curso" onkeyup="searchCert(this.value)">
                    </label>
                </form>
            </div>
        </div>
        <div class="row-justify-content-center">
            <div class="col-md-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Curso</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="tb">
                        <?php
                        $certificados = $dados->listar();
                        foreach ($certificados as $certificado) { ?>
                            <tr>
                                <td><?= htmlspecialchars($certificado['aluno']) ?></td>
                                <td><?= htmlspecialchars($certificado['curso']) ?></td>
                                <td>
                                    <a href="javascript:;" class="gerar-pdf" data-id="<?= $certificado['id_cert_done'] ?>">
                                        <button class="btn">Gerar PDF</button>
                                    </a>
                                    <?php if ($_SESSION['perfil'] == 2) { ?>
                                        <a href="javascript:;" data-id="<?php echo $certificado['id_cert_done'] ?>" class="delete"><button class="btn">Excluir</button></a>
                                </td>
                            <?php } ?>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>

        </div>
        <h5>Total de Registros: <?php echo count($certificados); ?></h5>
    </div>
    <dialog class="dialog">
        <div class="dialog-content">
            <div class="dialog-header">
                <h3>Selecione um Aluno:</h3>
                <form action="" method="post" class="form-cert">
                    <div class="sel-aluno">
                        <select name="aluno" id="aluno">
                            <option value="">Selecione</option>
                            <?php
                            $alunos = $aluno->listar();
                            foreach ($alunos as $aluno) { ?>
                                <option value="<?= $aluno['id_aluno'] ?>"><?= $aluno['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <h3>Selecione um Curso:</h3>
                        <select name="curso" id="curso">
                            <option value="">Selecione</option>
                            <?php
                            $cursos = $curso->listarTodos();
                            foreach ($cursos as $curso) { ?>
                                <option value="<?= $curso['id_curso'] ?>"><?= $curso['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

            </div>

        </div>
        <div class="btn-tiny">
            <div class="col-md-5">
                <button class="btn" name="iniciar" id="btn">Iniciar Preenchimento</button>
            </div>
        </div>
        </form>
        <div class="col-md-5">
            <button class="close">Cancelar</button>
        </div>



    </dialog>
</main>
<div class="preloader" style="display:none" id="preloader">
    <div class="loader" id="loader"></div>
</div>

<?php include "../Views/includes/footer.php"; ?>
<script>
    $(document).ready(function() {
        $('.delete').click(function() {
            var id = $(this).data('id');
            if (confirm("Está certo disto?")) {
                window.location.href = "/certificados/app/Views/gerarcertificado.php?delete=" + id;
            }
        });
    });
    $('.gerar-pdf').click(function() {
        var id = $(this).data('id');
        $('#preloader').css('display', 'flex');
        $.ajax({
            type: 'POST',
            url: '/certificados/app/Views/cert_pdf.php',
            data: {
                id: id
            },
            beforeSend: function() {
                $('#preloader').css('display', 'flex');
            },
            success: function(data) {
                setTimeout(function() {
                    $('#preloader').css('display', 'none');
                    window.location.href = "/certificados/app/Views/cert_pdf.php?id=" + id;
                }, 4000);
            },
            error: function() {
                $('#preloader').css('display', 'none');
            }
        });
    });

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