<?php
session_start();
include("./includes/session.php");

if (!isset($_SESSION['nome'])) {
    header('Location: /certificados');
    exit();
}

require_once '../Controlers/ProfessorController.php';
require_once '../Controlers/log.php';

use App\Controlers\Log;

$log = Log::getInstance();

use App\Controlers\ProfessorController;

$professorController = new ProfessorController();

if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $professorController->deletar($id);
    $log->info('Professor deletado com sucesso. ID: ' . $id);
    header('Location: professores');
    exit();
}

if (isset($_POST['cadastrar'])) {

    $nome = $_POST['Nome'];
    $titulo = $_POST['Titulo'];
    $professor = new ProfessorController();
    try {
        $professor->inserir($nome, $titulo);
    } catch (Exception $e) {
        echo "<script>alert('" . $e->getMessage() . "');</script>";
        echo "<script>window.location.href='professores';</script>";
        exit();
    }
    $log->info('Professor adicionado com sucesso: ' . $nome);

    echo "<script>alert('Professor adicionado com sucesso!');</script>";

    header("Location: professores");
    exit();
}

include "../Views/includes/header.php";

?>

<!-- lista todos os professores cadastrados -->
<main>
    <div class="container">
        <div class="title">
            <h3>Professores</h3>
            <div class="btn-alinhamento">
                <div class="col-md-5">
                    <button class="btn" id="btn-cad">Novo Professor</button>
                </div>
                <div class="col-md-5">
                    <a href="home">
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
                            <th>Título</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $professores = $professorController->listar();

                        foreach ($professores as $professor) {
                        ?>
                            <tr>
                                <td><?= $professor['name'] ?></td>
                                <td><?= $professor['titulo'] ?></td>
                                <td>
                                    <div class="col-md-5">
                                        <a href="editar_professor?x_edg3D=<?= $professor['id_professor'] ?>">
                                            <button class="btn">Editar</button>
                                        </a>
                                    </div>

                                    <?php if ($_SESSION['perfil'] == 2): ?>
                                        <div class="col-md-5">
                                            <a href="javascript:;" data-id="<?= $professor['id_professor'] ?>" class="delete">
                                                <button class="btn">Deletar</button>
                                            </a>
                                        </div>
                                </td>
                            <?php endif; ?>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <h5>Total de Professores: <?php echo count($professores); ?></h5>
            </div>

        </div>

    </div>
    <dialog id="addProf" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Cadastrar Professor</h3>

                    <form action="" method="post">
                        <br>
                        <div class="cad-prof">
                            <label for="Nome">Nome:</label><br>
                            <input class="cad-prof" type="text" name="Nome" id="Nome" placeholder="Nome" autofocus required><br>
                            <label for="Titulo">Título:</label><br>
                            <select class="cad-prof" name="Titulo" id="Titulo">
                                <option value="Especialista">Especialista</option>
                                <option value="Mestre">Mestre</option>
                                <option value="Doutor">Doutor</option>

                            </select>
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
        </div>
    </dialog>

</main>
<?php include "../Views/includes/footer.php"; ?>
<script>
    $(document).ready(function() {
        $('.delete').click(function() {
            var id = $(this).data('id');
            if (confirm("Está certo disto?")) {
                window.location.href = "/certificados/app/Views/professores.php?delete=" + id;
            }
        });
    });

    const button = document.querySelector("#btn-cad")

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