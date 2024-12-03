<?php

namespace App\Views;

session_start();
include("./includes/session.php");

require_once '../Controlers/CursoController.php';

if (!isset($_SESSION['nome'])) {
    header('Location: /certificados');
    exit();
}
require_once '../Controlers/log.php';

use App\Controlers\Log;

$log = Log::getInstance();

use App\Controlers\CursoController;
use Exception;

include "../Views/includes/header.php";

if (isset($_GET['_xasda_sda'])) {
    $id = $_GET['_xasda_sda'];
    $curso = new CursoController;
    $dados = $curso->dados($id);
    } else {
        echo "<script>window.location.href='cursos';</script>";
        exit();
    }

if (isset($_POST['editar'])) {

    $id = $_GET['_xasda_sda'];
    $nome = $_POST['Nome'];
    $ch = $_POST['CH'];
    $ies = $_POST['IES'];
    $parecer = $_POST['Parecer'];
    $parecer_curso = $_POST['Parecer_curso'];
    $modalidade = $_POST['Modalidade'];

    $curso = new CursoController();
    try {
        $curso->alterar($id, $nome, $ch, $ies, $parecer, $parecer_curso, $modalidade);
    } catch (Exception $e) {
        $log->info('Erro ao editar curso: ' . $e->getMessage());
        echo "<script>alert('" . $e->getMessage() . "');</script>";
        echo "<script>window.location.href='cadastrar_curso';</script>";
        exit();
    }

    $log->info('Curso editado com sucesso. Nome: ' . $nome);

    echo "<script>alert('Curso adicionado com sucesso!');</script>";

    header("Location: cursos");
}

?>

<!-- Formulário de cadastro do curso -->
<div class="container">
    <br>

    

    <h3>Atualização do Curso:</h3>

    <form class="curso" action="" method="post">
        <br>
        <div class="cad-curso">
            <div class="curso-nome">
                <div>
                    <label for="Nome">Nome:</label><br>
                    <input type="text" class="nome-curso" name="Nome" id="Nome-curso" value="<?php echo $dados['name']; ?>" placeholder="Nome" autofocus required><br>
                </div>
            </div>
            <div class="curso-ies">
                <div>
                    <label for="CH">Carga Horária:</label><br>
                    <input type="text" name="CH" id="CH" value="<?php echo $dados['c_horaria']; ?>" placeholder="Ex.: 540" required><br>
                </div>
                <div>
                    <label for="IES">Faculdade:</label><br>
                    <Select name="IES">
                        <option value="">Selecione</option>
                        <option value="Centro de Ensino Superior de Arcoverde" <?php echo ($dados['IES'] == 'Centro de Ensino Superior de Arcoverde') ? 'selected' : ''; ?>>Centro de Ensino Superior de Arcoverde</option>
                        <option value="Escola Superior de Saúde de Arcoverde" <?php echo ($dados['IES'] == 'Escola Superior de Saúde de Arcoverde') ? 'selected' : ''; ?>>Escola Superior de Saúde de Arcoverde</option>
                    </Select><br>
                </div>
                <div>
                    <label for="Parecer">Parecer:</label><br>
                    <input type="text" name="Parecer" id="Parecer" value="<?php echo $dados['parecer']; ?>" placeholder="Ex.: CEE/PE nº 167/2012" required><br>
                </div>
            </div>
            <div class="curso-parecer">
                <div>
                    <label for="Parecer_curso">Parecer do Curso:</label><br>
                    <input type="text" name="Parecer_curso" id="Parecer_curso" value="<?php echo $dados['parecer_curso']; ?>" placeholder="CEE/PE nº 86/2014" required><br>
                </div>
                <div>
                    <label for="Modalidade">Modalidade:</label><br>
                    <Select name="Modalidade" id="modalidade">
                        <option value="">Selecione</option>
                        <option value="Pós-Graduação Lato Sensu" <?php echo ($dados['tipo_curso'] == 'Pós-Graduação Lato Sensu') ? 'selected' : ''; ?>>Pós-Graduação Lato Sensu</option>
                        <option value="Pós-Graduação Stricto Sensu" <?php echo ($dados['tipo_curso'] == 'Pós-Graduação Stricto Sensu') ? 'selected' : ''; ?>>Pós-Graduação Stricto Sensu</option>
                        <option value="Pós-Graduação MBA" <?php echo ($dados['tipo_curso'] == 'Pós-Graduação MBA') ? 'selected' : ''; ?>>Pós-Graduação MBA</option>
                    </Select>
                </div>
            </div>
        </div>
        <br>
        <div class="col-md-5">
            <button class="btn" type="submit" name="editar">Editar</button>
        </div>
    </form>
    <div class="col-md-5">
        <a href="cursos">
            <button class="btn" type="button">Voltar</button>
        </a>

    </div>
</div>

<?php include "../Views/includes/footer.php"; ?>