<?php
session_start();
include("./includes/session.php");

if (!isset($_SESSION['nome'])) {
    header('Location: /certificados');
    exit();
}

require_once '../Controlers/AlunoController.php';

use App\Controlers\AlunoController;

$alunoController = new AlunoController();
$itensPorPagina = 5;
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$offset = ($paginaAtual - 1) * $itensPorPagina;
$alunos = $alunoController->searchAluno($_GET['q'], $itensPorPagina, $offset);
?>

<tbody class="tb" id="tb">
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
                        <button class="btn">Editar</button>
                    </a>
                </div>
                <?php if ($_SESSION['perfil'] == 2): ?>
                    <div class="col-md-5">
                        <a href="javascript:;" data-id="<?= $aluno['id_aluno'] ?>" class="delete">
                            <button class="btn">Deletar</button>
                        </a>
                    <?php endif; ?>
                    </div>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>