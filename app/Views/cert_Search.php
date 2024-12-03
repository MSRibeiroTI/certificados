<?php

namespace App\Views;

session_start();
require_once '../Controlers/CertificadoController.php';
require_once '../Controlers/AlunoController.php';
require_once '../Controlers/CursoController.php';

use App\Controlers\CertificadoController;
use App\Controlers\AlunoController;
use App\Controlers\CursoController;


if (!isset($_SESSION['nome'])) {
    header('Location: /certificados');
    exit();
}


$dados = new CertificadoController();
$aluno = new AlunoController();
$curso = new CursoController();
?>

<tbody id="tb">
    <?php
    $certificados = $dados->buscar($_GET['q']);
    foreach ($certificados as $certificado) { ?>

        <tr>
            <td><?= htmlspecialchars($certificado['aluno']) ?></td>
            <td><?= htmlspecialchars($certificado['curso']) ?></td>
            <td><a href="cert_pdf?id=<?= $certificado['id_cert_done'] ?>"><button class="btn">Gerar PDF</button></a>
                <?php if ($_SESSION['perfil'] == 2) { ?>
                    <a href="javascript:;" data-id="<?php echo $certificado['id_cert_done'] ?>" class="delete"><button class="btn">Deletar</button></a>
            </td>
        <?php } ?>
        </tr>

    <?php
    }
    ?>

</tbody>