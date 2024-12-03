<?php
session_start();


require_once '../Controlers/UsuarioController.php';
require_once '../Controlers/log.php';

use
    App\Controlers\UsuarioController;
use
    App\Controlers\Log;


$usuarioController = new UsuarioController();
$log = Log::getInstance();

if (isset($_GET['action']) && $_GET['action'] == 'login') {
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $senha = isset($_POST['senha']) ? $_POST['senha'] : null;
    if ($usuarioController->login($email, $senha)) {
        $_SESSION['Nome'] = true;
        $log->info('Usuário logado com sucesso.');
        header("Location: home");
    } else {
        $log->info('Email ou senha incorretos.');
        echo "<script>alert('Email ou senha incorretos.');</script>";
    }
} else {
    $log->info('Página de login acessada.');
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/png" sizes="32x32" rel="icon" href="/certificados/public/img/icons8-diploma-32.png">
    <title>Login</title>
    <link rel="stylesheet" href="/certificados/public/css/login.css">


</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h1 class="text-center">Login</h1>
                <form action="login.php?action=login" method="post">
                    <div class="form-group">
                        <label for="nome">Usuário</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="E-mail do usuário" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" name="senha" id="senha" placeholder="Digite sua senha" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Entrar</button>

                </form>
                <a href="/certificados/">
                    <button class="btn btn-primary"> Voltar
                    </button></a>
            </div>
        </div>
    </div>

</body>

</html>