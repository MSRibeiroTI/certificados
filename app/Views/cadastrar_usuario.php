<?php

namespace App\Views;

session_start();
include("./includes/session.php");

if ($_SESSION['perfil'] == 1 || empty($_SESSION['nome'])) {
    echo "<script>alert('Usuário não autorizado! Apenas Administradores.');</script>";
    echo "<script>window.location.href='users';</script>";
    return;
}

use App\Controlers\UsuarioController;
use Exception;

require_once '../Controlers/UsuarioController.php';
require_once '../Controlers/log.php';

use App\Controlers\Log;

$log = Log::getInstance();

include "../Views/includes/header.php";

if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $perfil = $_POST['perfil'];
    $usuario = new UsuarioController();
    try {
        $usuario->cadastrar($nome, $email, $senha, $perfil);
    } catch (Exception $e) {
        $log->info('Erro ao cadastrar usuário' . $e->getMessage());
        echo "<script>alert('" . $e->getMessage() . "');</script>";
        echo "<script>window.location.href='cadastrar_usuario';</script>";
        exit;
    }

    $log->info('Usário ' . $nome . ' adicionado.');

    echo "<script>alert('Usário adicionado com sucesso!');</script>";

    header("Location: users");
    exit;
}

?>
<div class="container">
    <br><br><br>
    <h3>Cadastrar Novo Usuário:</h3>
    <form action="" method="post">
        <br>
        <div class="cad-user">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required><br>

            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required><br>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required><br>

            <label for="perfil">Perfil:</label>
            <select name="perfil" id="perfil">
                <option value="1">Usuário</option>
                <option value="2">Administrador</option>
            </select><br><br>
        </div>
        <div class="col-md-5">
            <button class="btn" type="submit" name="cadastrar">Cadastrar</button>
        </div>
    </form>
    <div class="col-md-5">
        <a href="users"><button class="btn" type="button">Voltar</button></a>
    </div>
</div>
<?php include "../Views/includes/footer.php" ?>