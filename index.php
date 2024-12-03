<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link type="image/png" sizes="32x32" rel="icon" href="/certificados/public/img/icons8-diploma-32.png">
    <link rel="stylesheet" href="./public/css/index.css">
    <title>Gerador de Certificados</title>
</head>

<body>
    <?php
    require './vendor/autoload.php';

    $url = new Core\ConfigController();

    $view = new Core\ConfigView();
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="title">
                <img src="./public/img/aesa.png" alt="Logotipo da Aesa">
                <h1 class="display-4">Autarquia de Ensino Superior de Arcoverde</h1>
                <h2 class="display-5">SISCERT - Sistema Gerador de Certificados da Pós-Graduação</h2>
            </div>

        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-8 text-center">
                <img src="./public/img/professor.jpg" alt="Imagem de um professor em uma sala de aula" class="img-fluid">
                <p class="lead">O SISCERT é um sistema de gerenciamento de certificados de cursos de pós-graduação, desenvolvido para atender às necessidades da Autarquia de Ensino Superior de Arcoverde.</p>
            </div>

        </div>
        <div class="">
            <div class="col-md-4 offset-md-4 text-center">
                <a href="<?php echo $view->redirecionarLogin('login'); ?>"><button class="btn btn-primary">Acessar</button></a>
            </div>

        </div>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyXn3ZVFFQ6uZq4v7/9qRJ7" crossorigin="anonymous"></script>
    </div>
</body>

</html>