<?php
session_start();
include("./includes/session.php");

if (!isset($_SESSION['nome'])) {
    header('Location: /certificados');
    exit();
}

require_once '../Controlers/AlunoController.php';
require_once '../Controlers/log.php';

use App\Controlers\Log;

$log = Log::getInstance();

use App\Controlers\AlunoController;

$alunoController = new AlunoController();



if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $alunoController->deletar($id);
    $log->info('Aluno deletado com sucesso. ID: ' . $id);
    header('Location: alunos');
    exit();
}

/* O código PHP está lidando com dados de envio de formulário de uma solicitação POST. Ele verifica se a chave
'cadastrar' está definida no array. Se estiver definido, o código recupera vários valores de campo de formulário como
nome, nome do pai, nome da mãe, data de nascimento, nacionalidade, etc. Em seguida, ele cria uma nova instância da classe
AlunoController e tenta inserir os dados no banco de dados usando o método inserir do controlador. */
if (isset($_POST['cadastrar'])) {

    $nome = $_POST['Nome'];
    $pai = $_POST['Pai'];
    $mae = $_POST['Mae'];
    $nascimento = $_POST['Nascimento'];
    $nacionalidade = $_POST['Nacionalidade'];
    $naturalidade = $_POST['Naturalidade'];
    $rg = $_POST['RG'];
    $emissor = $_POST['emissor'];
    $graduacao = $_POST['Graduacao'];
    $aluno = new AlunoController();
    try {
        $aluno->inserir($nome, $nacionalidade, $naturalidade, $pai, $mae, $nascimento, $rg, $emissor, $graduacao);
    } catch (Exception $e) {
        echo "<script>alert('" . $e->getMessage() . "');</script>";
        $log->info('Erro do cadastrar aluno. ' . $e->getMessage());
        echo "<script>window.location.href='alunos';</script>";
        exit();
    }

    $log->info('Aluno adicionado com sucesso: ' . $nome);

    echo "<script>alert('Aluno adicionado com sucesso!');</script>";

    header("Location: alunos");
    exit();
}
$itensPorPagina = 10;
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$offset = ($paginaAtual - 1) * $itensPorPagina;

include "../Views/includes/header.php";
?>
<main>
    <div class="container">
        <div class="title">
            <h3>Alunos</h3>
            <div class="btn-alinhamento">
                <div class="col-md-5">
                    <button class="btn" id="btn-cadastro"> Novo Aluno</button>
                </div>
                <div class="col-md-5">
                    <a href="home">
                        <button class="btn">Voltar</button>
                    </a>
                </div>

            </div>
            <div class="search">
                <form action="" class="form_search" method="get" id="form_search">
                    <label class="input_search">
                        <input type="text" id="pesquisa" name="q" placeholder="Pesquisar Aluno" onkeyup="search(this.value)">
                    </label>
                </form>
            </div>
        </div>
        <div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Nacionalidade</th>
                                <th>Naturalidade</th>
                                <th>Pai</th>
                                <th>Mãe</th>
                                <th>Nascimento</th>
                                <th>R.G.</th>
                                <th>Emissor</th>
                                <th>Graduação</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <?php

                        $alunos = $alunoController->searchAluno($_GET['q'] ?? '', $offset, $itensPorPagina);

                        if (!empty($alunos)) :
                        ?>
                            <tbody id="tb">
                                <?php

                                foreach ($alunos as $aluno):
                                ?>
                                    <tr>
                                        <td><?= htmlspecialchars($aluno['name']) ?></td>
                                        <td><?= $aluno['nacionalidade'] ?></td>
                                        <td><?= $aluno['naturalidade'] ?></td>
                                        <td><?= $aluno['pai'] ?></td>
                                        <td><?= $aluno['mae'] ?></td>
                                        <td><?= date("d/m/Y", strtotime($aluno['nascimento'])) ?></td>
                                        <td><?= $aluno['rg'] ?></td>
                                        <td><?= $aluno['emissor'] ?></td>
                                        <td><?= $aluno['graduacao'] ?></td>

                                        <td>
                                            <div class="col-md-5">
                                                <a href="editar_aluno?_s-tga_=<?= $aluno['id_aluno'] ?>">
                                                    <button class="btn-tb">Editar</button>
                                                </a>
                                            </div>
                                            <?php if ($_SESSION['perfil'] == 2): ?>
                                                <div class="col-md-5">
                                                    <a href="javascript:;" data-id="<?= $aluno['id_aluno'] ?>" class="delete">
                                                        <button class="btn-tb">Deletar</button>
                                                    </a>
                                                <?php endif; ?>
                                                </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                    </table>
                </div>
                <h5>Total de Registros: <?php echo count($alunos); ?> de <?php echo count($alunoController->listarTodos()); ?></h5>
            </div>
            <?php
                            $totalAlunos = count($alunoController->listarTodos());
                            $totalPaginas = ceil($totalAlunos / $itensPorPagina);
                            $MaxLinks = 2;
            ?>
            <div class="pages" style="display: flex; flex-direction: row; gap: 10px; align-items: center; justify-content: center; margin-bottom: 20px;">
                Páginas: <br> <a href="?pagina=1">
                    << </a>

                        <?php for ($i = $paginaAtual - $MaxLinks; $i <= $paginaAtual - 1; $i++) : ?>
                            <?php if ($i > 0) : ?>
                                <a href="?pagina=<?php echo $i; ?>" onclick=""><?php echo $i; ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <?php echo $paginaAtual; ?>

                        <?php for ($i2 = $paginaAtual + 1; $i2 <= $paginaAtual + $MaxLinks; $i2++) : ?>
                            <?php if ($i2 <= $totalPaginas) : ?>
                                <a href="?pagina=<?php echo $i2; ?>"><?php echo $i2; ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <a href="?pagina=<?php echo $totalPaginas; ?>"> >></a>

            </div>

        </div>
    <?php endif; ?>
    </div>
    <dialog id="cad-aluno" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Cadastro de Aluno</h3>

                    <form class="aluno" action="" method="post">
                        <br>
                        <div class="cad-aluno">
                            <label for="Nome">Nome:</label><br>
                            <input type="text" name="Nome" id="Nome" placeholder="Nome" autofocus required><br>
                            <label for="Pai">Pai:</label><br>
                            <input type="text" name="Pai" id="Pai" placeholder="Pai" required><br>
                            <label for="Mae">Mãe:</label><br>
                            <input type="text" name="Mae" id="Mae" placeholder="Mãe" required><br>
                            <div class="nasc">
                                <div class="nasci">
                                    <label for="Nascimento">Nascimento:</label><br>
                                    <input type="date" name="Nascimento" id="Nascimento" placeholder="Nascimento" required><br>
                                </div>
                                <div class="nacio">
                                    <label for="Nacionalidade">Nacionalidade:</label><br>
                                    <input type="text" name="Nacionalidade" id="Nacionalidade" placeholder="Nacionalidade" required><br>
                                </div>
                                <div class="natur">
                                    <label for="Naturalidade">Naturalidade:</label><br>
                                    <input type="text" name="Naturalidade" id="Naturalidade" placeholder="Ex: Arcoverde - PE" required><br>
                                </div>
                            </div>
                            <div class="rg">
                                <div>
                                    <label for="RG">RG:</label><br>
                                    <input type="text" name="RG" id="RG" placeholder="00000-0" required><br>
                                </div>
                                <div>
                                    <label for="emissor">Órgão Emissor:</label><br>
                                    <input type="text" name="emissor" id="emissor" placeholder="EX.: SDS-PE" required><br>
                                </div>
                                <div>
                                    <label for="Graduacao">Graduação:</label><br>
                                    <input type="text" name="Graduacao" id="Graduacao" placeholder="Ex: Licenciado em Pedagogia" required><br>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <button class="btn" type="submit" name="cadastrar">Cadastrar</button>
                        </div>
                    </form>
                    <div class="col-md-5">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
    </dialog>
</main>

<?php include "../Views/includes/footer.php"; ?>
<script>
    $(document).ready(function() {
        $('.delete').click(function() {
            var id = $(this).data('id');
            if (confirm("Está certo disto?")) {
                window.location.href = "/certificados/app/Views/alunos.php?delete=" + id;
            }
        });
    });

    const button = document.querySelector("#btn-cadastro")

    button.addEventListener("click", () => {
        const dialog = document.querySelector("dialog")
        dialog.showModal()
    })

    const close = document.querySelector(".close")

    close.addEventListener("click", () => {
        const dialog = document.querySelector("dialog")
        dialog.close()
    })
</script>