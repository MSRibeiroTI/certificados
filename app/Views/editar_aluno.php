<?php

namespace App\Views;

session_start();
include("./includes/session.php");

require_once '../Controlers/AlunoController.php';

if (!isset($_SESSION['Nome'])) {
    header('Location: /certificados');
    exit();
}
require_once '../Controlers/log.php';

use App\Controlers\Log;
use Exception;

$log = Log::getInstance();

use App\Controlers\AlunoController;

if (isset($_GET['_s-tga_'])) {
    $id = $_GET['_s-tga_'];
    $aluno = new AlunoController();
    $dados = $aluno->listarCert($id);
}

if (isset($_POST['editar'])) {

    $nome = $_POST['Nome'];
    $pai = $_POST['Pai'];
    $mae = $_POST['Mae'];
    $nascimento = $_POST['Nascimento'];
    $nacionalidade = $_POST['Nacionalidade'];
    $naturalidade = $_POST['Naturalidade'];
    $rg = $_POST['RG'];
    $emissor = $_POST['emissor'];
    $graduacao = $_POST['Graduacao'];
    $id = $_GET['_s-tga_'];

    $aluno = new AlunoController();
    try {
        $aluno->update($id, $nome, $nacionalidade, $naturalidade, $pai, $mae, $nascimento, $rg, $emissor, $graduacao);

        $log->info('Aluno editado com sucesso. ID: ' . $nome);

        header('Location: alunos');
        exit();
    } catch (Exception $e) {
        $log->info('Erro ao editar aluno. ID: ' . $id . ' Mensagem: ' . $e->getMessage());
        echo $e->getMessage();
    }
}

include "../Views/includes/header.php";


?>


<!-- Formulário de cadastro do aluno -->
<div class="container">
    <br>
    <h3>Editar Aluno</h3>

    <form class="aluno-edit" action="" method="post">
        <br>
        <div class="cad-aluno">
            <label for="Nome">Nome:</label><br>
            <input type="text" name="Nome" id="Nome" value="<?php echo $dados['name']; ?>" placeholder="Nome" autofocus required><br>
            <label for="Pai">Pai:</label><br>
            <input type="text" name="Pai" id="Pai" value="<?php echo $dados['pai']; ?>" placeholder="Pai" required><br>
            <label for="Mae">Mãe:</label><br>
            <input type="text" name="Mae" id="Mae" value="<?php echo $dados['mae']; ?>" placeholder="Mãe" required><br>
            <div class="nasc">
                <div class="nasci">
                    <label for="Nascimento">Nascimento:</label><br>
                    <input type="date" name="Nascimento" id="Nascimento" value="<?php echo $dados['nascimento']; ?>" placeholder="Nascimento" required><br>
                </div>
                <div class="nacio">
                    <label for="Nacionalidade">Nacionalidade:</label><br>
                    <input type="text" name="Nacionalidade" id="Nacionalidade" value="<?php echo $dados['nacionalidade']; ?>" placeholder="Nacionalidade" required><br>
                </div>
                <div class="natur">
                    <label for="Naturalidade">Naturalidade:</label><br>
                    <input type="text" name="Naturalidade" id="Naturalidade" value="<?php echo $dados['naturalidade']; ?>" placeholder="Ex: Arcoverde - PE" required><br>
                </div>
            </div>
            <div class="rg">
                <div>
                    <label for="RG">RG:</label><br>
                    <input type="text" name="RG" id="RG" value="<?php echo $dados['rg']; ?>" placeholder="00000-0 SSP/PE" required><br>
                </div>
                <div>
                    <label for="emissor">Emissor:</label><br>
                    <input type="text" name="emissor" id="emissor" value="<?php echo $dados['emissor']; ?>" placeholder="EX.: SDS-PE" required><br>
                </div>
                <div>
                    <label for="Graduacao">Graduação:</label><br>
                    <input type="text" name="Graduacao" id="Graduacao" value="<?php echo $dados['graduacao']; ?>" placeholder="Ex: Licenciado em Pedagogia" required><br>
                </div>
            </div>
        </div>

</div>
<div class="btn-tiny">
    <div class="col-md-5">
        <button class="btn" type="submit" name="editar">Salvar</button>
    </div>
</div>
</form>
<div class="btn-tiny">
    <div class="col-md-5">
        <a href="alunos">
            <button class="btn" type="button">Voltar</button>
        </a>

    </div>
</div>

</div>






<?php
include "../Views/includes/footer.php";
?>