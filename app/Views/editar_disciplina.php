<?php

namespace App\Views;

session_start();
include("./includes/session.php");
if (!isset($_SESSION['nome'])) {
    header('Location: /certificados');
    exit();
}

require_once '../Controlers/DisciplinaController.php';
require_once '../Controlers/log.php';

use App\Controlers\Log;

$log = Log::getInstance();

use App\Controlers\DisciplinaController;
use Exception;


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $curso = $_GET['_curso'];
    $disciplina = new DisciplinaController();
    $dados = $disciplina->dados($id);
}

if (isset($_POST['edit_disciplina'])) {
    $nome = $_POST['nomeDisciplina'];
    $ch = $_POST['cargaHoraria'];
    try {
        $disciplina->atualizar($id, $nome, $ch);
        $log->info('Disciplina atualizada com sucesso. ID: ' . $id . 'Nome: ' . $nome);
        header('Location: disciplinas?curso=' . $curso);
        exit;
    } catch (Exception $e) {
        $log->info($e->getMessage());
        echo "<script>alert('" . $e->getMessage() . "');</script>";
        echo "<script>window.location.href='editar_disciplina?id=" . $id . "&_curso=" . $curso . "';</script>";
        exit;
    }
}

include_once '../Views/includes/header.php';

?>
<div class="container">
    <div class="title">
        <h2>Editar Disciplina</h2>
    </div>
    <form action="" method="post" id="form">
        <div class="form-group"><br>
            <label for="nomeDisciplina">Nome da Disciplina</label><br>
            <input type="text" class="form-control" id="nomeDisciplina" name="nomeDisciplina" value="<?php echo $dados['name']; ?>" placeholder="Informe o nome da disciplina" required>
        </div>
        <div class="form-group"><br>
            <label for="cargaHoraria">Carga Horária</label><br>
            <input type="number" class="form-control" id="cargaHoraria" name="cargaHoraria" value="<?php echo $dados['c_h']; ?>" placeholder="Informe a carga horária" required>
        </div>
        <div class="col-md-5">
            <button type="submit" name="edit_disciplina" class="btn">Salvar</button>
        </div>
    </form>
    <div class="col-md-5">
        <a href="disciplinas?curso=<?php echo $curso; ?>">
            <button class="btn">Voltar</button>
        </a>
    </div>

    <?php include "../Views/includes/footer.php"; ?>
