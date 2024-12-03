<?php
session_start();
include("./includes/session.php");

if (!isset($_SESSION['Nome'])) {
    header('Location: /certificados');
}
include "../Views/includes/header.php";


require '/xampp/htdocs/certificados/vendor/autoload.php';

$url = new Core\ConfigController();

$view = new Core\ConfigView();


?>

<main>
    <div class="menu">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">

                    <a href="<?php echo $view->redirecionar('alunos'); ?>">
                        <button class="btn btn-primary"><ion-icon name="people-circle-outline"></ion-icon> Alunos
                        </button>
                    </a>

                    <a href="<?php echo $view->redirecionar('professores'); ?>">
                        <button class="btn btn-primary"><ion-icon name="glasses-outline"></ion-icon> Professores
                        </button>
                    </a>
                    <a href="<?php echo $view->redirecionar('cursos'); ?>">
                        <button class="btn btn-primary"><ion-icon name="library-outline"></ion-icon> Cursos
                        </button>
                    </a>
                    <a href="<?php echo $view->redirecionar('users'); ?>">
                        <button class="btn btn-primary"><ion-icon name="person-circle-outline"></ion-icon> Usuários
                        </button>
                    </a>
                    <a href="<?php echo $view->redirecionar('gerarcertificado'); ?>">

                        <button class="btn btn-primary"> <ion-icon name="reader-outline"></ion-icon> Gerar Certificado
                        </button>
                    </a>
                    <a href="<?php echo $view->redirecionar('help/'); ?>" target="_blank">

                        <button class="btn btn-primary"> <ion-icon name="help"></ion-icon> Ajuda
                        </button>
                    </a>

                    <?php if ($_SESSION['perfil'] == 2) { ?>
                        <a href="<?php echo $view->redirecionar('config'); ?>">
                            <button class="btn btn-primary"> <ion-icon name="construct-outline"></ion-icon> Configurar o Sistema
                            </button>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include "../Views/includes/footer.php"
?>