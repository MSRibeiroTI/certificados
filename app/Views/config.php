<?php

namespace App\Views;

session_start();
include("./includes/session.php");

require_once '../Models/backup.php';

use App\Models\backup;
use App\Controlers\CertificadoController;


include_once '../Views/includes/header.php';

if (!isset($_SESSION['nome']) || $_SESSION['perfil'] == 1) {
    header('Location: home');
    exit();
}

if (isset($_POST['backup'])) {
    $backup = backup::getInstance();
    $backup->backup();
}

if (isset($_POST['alterar'])) {
    $certificadoController = new CertificadoController();
    $opt = $_POST['opt'];
    $certificadoController->trocarLogo($opt);
}

?>
<div class="container">

    <div class="alt-logo">
        <br>
        <h3>Configurações do Sistema</h3>


        <form class="form-logo" action="" method="post">
            <div class="col-md-5">
                <button type="submit" class="btn" name="backup">Backup</button>
            </div>
        </form>
    </div>

    <div class="config-logo">

        <div class="alt-logo">
            <h3>Atualizar Imagem</h3>
            <img src="./img/cesa.png" alt="" style="width: 50%;">
            <form class="form-logo" action="" method="post" enctype="multipart/form-data">
                <p>Tamanho: 563 x 227 pixels - Formato: png</p>
                <input type="file" name="logo" id="logo" accept=".png" required>
                <input type="hidden" name="opt" value="cesa">
                <div class="col-md-5">
                    <button class="btn" type="submit" name="alterar">Alterar</button>
                </div>
            </form>

        </div>

        <div class="alt-logo">
            <h3>Atualizar Imagem</h3>
            <img src="./img/essa.png" alt="" style="width: 50%;">
            <form class="form-logo" action="" method="post" enctype="multipart/form-data">
                <p>Tamanho: 563 x 227 pixels - Formato: png</p>
                <input type="file" name="logo" id="logo" accept=".png" required>
                <input type="hidden" name="opt" value="essa">
                <div class="col-md-5">
                    <button class="btn" type="submit" name="alterar">Alterar</button>
                </div>

            </form>

        </div>

        <div class="alt-logo">
            <h3>Alterar fundo do certificado</h3>
            <img src="./img/fundo_cert.png" alt="" style="width: 25%;">
            <form class="form-logo" action="" method="post" enctype="multipart/form-data">
                <p>Tamanho: 3422 x 2402 pixels - Formato: png</p>
                <input type="file" name="logo" id="logo" accept=".png" required>
                <input type="hidden" name="opt" value="fundo">
                <div class="col-md-5">
                    <button class="btn" type="submit" name="alterar">Alterar</button>
                </div>
            </form>

        </div>
    </div>

    <div class="log">
        <h3>Log do Sistema</h3>
        <div style="overflow-y:scroll; height:300px;">
            <?php
            $arquivo = file('/xampp/htdocs/certificados/siscert_log.txt');

            $arquivo = array_reverse($arquivo);
            foreach ($arquivo as $linha) {
                echo $linha . "<br>";
            }
            ?>
        </div>
    </div>
</div>

<div class="col-md-5">
    <a href="home"><button class="btn" type="button">Voltar</button></a>
</div>
<br><br>
<?php include_once '../Views/includes/footer.php'; ?>