<?php
session_start();
include("./includes/session.php");

if (!isset($_SESSION['Nome'])) {
    header('Location: /certificados');
    exit();
}

require_once '../Controlers/UsuarioController.php';

use App\Controlers\UsuarioController;

$usuarioController = new UsuarioController();
require_once '../Controlers/log.php';

use App\Controlers\Log;

$log = Log::getInstance();



if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $usuarioController->deletar($id);
    $log->info('Usuário deletado com sucesso. ID: ' . $id);
    header('Location: users');
    exit();
}
include "../Views/includes/header.php";
?>
<!-- lista todos os usuários cadastrados -->
<main>
    <div class="container">
        <div class="title">
            <h3>Usuários</h3>
            <div class="btn-alinhamento">
                <?php if ($_SESSION['perfil'] == 2): ?>
                    <div class="col-md-5">
                        <a href="/certificados/app/Views/cadastrar_usuario">
                            <button class="btn"> Novo Usuário</button>
                        </a>
                    </div>
                <?php endif; ?>
                <div class="col-md-5">
                    <a href="home">
                        <button class="btn">Voltar</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="row-justify-content-center">
            <div class="col-md-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Perfil</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $usuarios = $usuarioController->listar();

                        foreach ($usuarios as $usuario):
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($usuario['name']) ?></td>
                                <td><?= htmlspecialchars($usuario['email']) ?></td>
                                <td><?= $usuario['perfil'] == 1 ? 'Usuário' : 'Administrador' ?></td>
                                <td>
                                    <div class="col-md-5">
                                        <?php if ($usuario['id_user'] == $_SESSION['id']  || $_SESSION['perfil'] == 2): ?>
                                            <a href="/certificados/app/Views/editar_usuario?id=<?= $usuario['id_user'] ?>">
                                                <button class="btn-tb">Editar</button>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($_SESSION['perfil'] == 2): ?>
                                        <div class="col-md-5">
                                            <?php if ($usuario['id_user'] != $_SESSION['id']): ?>
                                                <a href="javascript:;" data-id="<?= $usuario['id_user'] ?>" class="delete">
                                                    <button class="btn-tb">Deletar</button>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <h5>Total de Usuários: <?php echo count($usuarios); ?></h5>
                <br><br>
            </div>
        </div>
    </div>
</main>
<?php include "../Views/includes/footer.php"; ?>
<script>
    $(document).ready(function() {
        $('.delete').click(function() {
            var id = $(this).data('id');
            if (confirm("Está certo disto?")) {
                window.location.href = "/certificados/app/Views/users.php?delete=" + id;
            }
        });
    });
</script>