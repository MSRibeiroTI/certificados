<?php

namespace App\Views;

session_start();
include("./includes/session.php");

if (!isset($_SESSION['Nome'])) {
    header('Location: /certificados');
    exit();
}

require_once '../Controlers/ProfessorController.php';
require_once '../Controlers/log.php';

use App\Controlers\Log;

$log = Log::getInstance();

use App\Controlers\ProfessorController;
use Exception;

include "../Views/includes/header.php";
if(isset($_GET['x_edg3D'])){
    $id = $_GET['x_edg3D'];
    $professor = new ProfessorController;
    $dados = $professor->dados($id);
    } else {
        echo "<script>window.location.href='professores';</script>";
        exit();
    }

    if (isset($_POST['alterar'])) {
        $nome = $_POST['Nome'];
        $titulo = $_POST['Titulo'];
        $professor = new ProfessorController();
        try {
            $professor->alterar($nome, $titulo, $id);
        } catch (Exception $e) {
            $log->info($e->getMessage());
            echo "<script>alert('" . $e->getMessage() . "');</script>";
        }
        $log->info('Professor ' . $nome . ' alterado com sucesso.');
        echo "<script>window.location.href='professores';</script>";
        exit();
    }

?>

<!-- Formulário de cadastro do professor -->
<div class="container">
    <br>
    <h3>Cadastro de Professor</h3>

    <form action="" method="post">
        <br>
        <div class="cad-prof">
            <label for="Nome">Nome:</label><br>
            <input class="cad-prof" type="text" name="Nome" value="<?php echo $dados['name']; ?>" id="Nome" placeholder="Nome" autofocus required><br>
            <label for="Titulo">Título:</label><br>
            <select class="cad-prof" name="Titulo" id="Titulo">
                <option value="Especialista" <?php echo ($dados['titulo'] == 'Especialista') ? 'selected' : ''; ?>>Especialista</option>
                <option value="Mestre" <?php echo ($dados['titulo'] == 'Mestre') ? 'selected' : ''; ?>>Mestre</option>
                <option value="Doutor" <?php echo ($dados['titulo'] == 'Doutor') ? 'selected' : ''; ?>>Doutor</option>

            </select>
        </div>
        <div class="col-md-5">
            <button class="btn" type="submit" name="alterar">Salvar</button>
        </div> 

    </form>
    <div class="col-md-5">
        <a href="professores">
            <button class="btn" type="button">Voltar</button>
        </a>

    </div>

</div>

<?php include "../Views/includes/footer.php"; ?>