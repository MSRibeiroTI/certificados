<?php
session_start();
require_once '../Controlers/log.php';
use
    App\Controlers\Log;

$log = Log::getInstance();
$log->info('Saiu do sistema: ');
unset($_SESSION["usuario"]);
unset($_SESSION["nome"]);
session_destroy();
print "<script>location.href='/certificados';</script>";
exit;
