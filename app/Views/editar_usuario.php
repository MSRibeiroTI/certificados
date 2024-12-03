<?php
session_start();
include("./includes/session.php");

if (!isset($_SESSION['Nome']) || (($_GET['id']) != ($_SESSION['id']) && ($_SESSION['perfil'] != 2))) {
    header('Location: users');
    exit();
}

include "../Views/includes/header.php";

$id = $_GET['id'];

require '/xampp/htdocs/certificados/vendor/autoload.php';
require_once '../Controlers/log.php';

use App\Controlers\Log;

$log = Log::getInstance();

use App\Controlers\UsuarioController;

$usuario = new UsuarioController();

if (isset($_POST['updSenha'])) {
    $password = $_POST['password'];
    $id = $_GET['id'];
    $usuario->updPass($password, $id);
    $log->info('Senha alterada com sucesso. ID: ' . $id);
    header('Location: users');
}

if (isset($_POST['updUser'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $id = $_GET['id'];
    $perfil = $_POST['perfil'];
    $usuario->updUser($nome, $email, $id, $perfil);
    $log->info('Usuário alterado com sucesso. ' . $nome);
    header('Location: users');
}

$usuario = $usuario->editar($id);

?>

<main>

    <div class="container">
        <h3>Editar Usuário:</h3>
        <form action="" method="post">
            <br><br>
            <div class="edit-user">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?php echo $usuario['name']; ?>" required><br>

                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" value="<?php echo $usuario['email']; ?>" required><br>


                <?php if ($_SESSION['perfil'] == 2) { ?>
                    <label for="perfil">Perfil:</label>
                    <select name="perfil" id="perfil">
                        <option value="1" <?php echo $usuario['perfil'] == 1 ? 'selected' : ''; ?>>Usuário</option>
                        <option value="2" <?php echo $usuario['perfil'] == 2 ? 'selected' : ''; ?>>Administrador</option>
                    </select><br><br>
                <?php } ?>
            </div>
            <div class="col-md-5">
                <button class="btn" type="submit" name="updUser">Salvar</button>
            </div>
        </form>

        <br>
        <form action="" method="post">
            <h3>Alterar Senha:</h3>
            <input type="password" id="password" name="password" placeholder="Nova senha" required>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirme a nova senha" required>

            <script>
                $('#confirm-password').on('keyup', function() {
                    if ($('#password').val() == $('#confirm-password').val()) {
                        $('#message').html('<div class="col-md-5"><br><button type="submit" name="updSenha" class="btn">Salvar</button></div>');

                    } else {
                        $('#message').html('<br>As senhas não coincidem<br><br>').css('color', 'red');
                    }
                })
            </script>
            <div><span id="message"></span></div>
            <br>
        </form>
        <div class="col-md-5">
            <a href="users"><button class="btn" type="button">Voltar</button></a>
        </div>
    </div>

</main>

<?php
include "../Views/includes/footer.php"
?>