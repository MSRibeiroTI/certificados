<?php

// Define o tempo limite em segundos (30 minutos)
$tempo_limite = 1800;

if (isset($_SESSION['ultimo_acesso'])) {
$inatividade = time() - $_SESSION['ultimo_acesso'];
if ($inatividade > $tempo_limite) {
session_unset(); // Remove todas as variáveis de sessão
session_destroy(); // Destroi a sessão
header("Location: login.php"); // Redireciona para a página de login
exit();
}
}

$_SESSION['ultimo_acesso'] = time(); // Atualiza o tempo do último acesso

?>