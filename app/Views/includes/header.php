<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="/certificados/public/js/busca.js"></script>
    <link type="image/png" sizes="32x32" rel="icon" href="/certificados/public/img/icons8-diploma-32.png">
    <link rel="stylesheet" href="/certificados/public/css/home.css">
    <title>SISCERT</title>
</head>

<body>
    <header>


        <nav>
            <div class="user">
                <ul>
                    <ion-icon name="person-outline"></ion-icon>
                    <h6><?php echo $_SESSION['nome']; ?></h6>
                    <li><a href="logout.php">Sair</a></li>
                </ul>
            </div>
        </nav>
        <h1>Bem-vindo ao SISCERT</h1>
        <h4>Sistema Gerador de Certificados da Pós-Graduação</h4>
    </header>
    <!-- ionincons -->

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>