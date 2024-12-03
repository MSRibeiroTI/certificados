<?php

namespace App\Views;

session_start();
include("./includes/session.php");

if (!isset($_SESSION['nome'])) {
    header('Location: /certificados');
    exit();
}

require_once '../Controlers/CertificadoController.php';
require_once '../Controlers/AlunoController.php';
require_once '../Controlers/CursoController.php';
require_once '../Controlers/ProfessorController.php';
require_once '../Controlers/DisciplinaController.php';

use App\Controlers\CertificadoController;
use App\Controlers\CursoController;
use APP\Controlers\AlunoController;
use App\Controlers\ProfessorController;
use App\Controlers\DisciplinaController;

if (isset($_GET['aluno'])) {
    $aluno = new AlunoController();
    $curso = new CursoController();
    $disciplina = new DisciplinaController();
    $professor = new ProfessorController();
    $professores = $professor->listar();
}
if ($_GET['aluno'] == "" || $_GET['curso'] == "") {
    header('Location: gerarcertificado');
    exit();
}

if (isset($_POST['gerar'])) {
    $certificado = new CertificadoController();
    $certificado->gerarCertificado(
        $_POST['aluno'],
        $_POST['nacionalidade'],
        $_POST['naturalidade'],
        $_POST['pai'],
        $_POST['mae'],
        $_POST['rg'],
        $_POST['nascimento'],
        $_POST['graduado'],
        $_POST['curso'],
        $_POST['c_hor_curso'],
        $_POST['ies'],
        $_POST['parecer'],
        $_POST['parece_curso'],
        $_POST['tipo_curso'],
        $_POST['disc'],
        $_POST['ch'],
        $_POST['inicio_curso'],
        $_POST['fim_curso'],
        $_POST['data_certi'],
        $_POST['diretor'],
        $_POST['tcc'],
        $_POST['freq'],
        $_POST['nota'],
        $_POST['prof'],
        $_POST['titulo']
    );

    echo "<script>window.location.href='gerarcertificado';</script>";
}

include "../Views/includes/header.php";
?>
<main>
    <div class="container">
        <div class="title">
            <h3>Gerar Certificado</h3>
        </div>

        <form class="certificado" action="" method="post">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <?php if (isset($_GET['aluno'])) {
                        $dados = $aluno->listarCert($_GET['aluno']);
                    }
                    ?>
                    <div class="form-group">
                        <div class="campo1">
                            <div>
                                Aluno: <br><input type="text" name="aluno" id="aluno" value="<?php echo (isset($dados['name']) ? $dados['name'] : '') ?>" readonly><br>
                            </div>
                            <div>
                                Nacionalidade: <input type="text" name="nacionalidade" id="nacionalidade" value="<?php echo (isset($dados['nacionalidade']) ? $dados['nacionalidade'] : '') ?>" readonly><br>
                            </div>
                            <div>
                                Naturalidade: <input type="text" name="naturalidade" id="naturalidade" value="<?php echo (isset($dados['naturalidade']) ? $dados['naturalidade'] : '') ?>" readonly><br>
                            </div>
                            <div>
                                Pai: <input type="text" name="pai" id="pai" value="<?php echo (isset($dados['pai']) ? $dados['pai'] : '') ?>" readonly><br>
                            </div>
                            <div>
                                Mãe: <input type="text" name="mae" id="mae" value="<?php echo (isset($dados['mae']) ? $dados['mae'] : '') ?>" readonly><br>
                            </div>
                        </div>


                        <div class="campo1">
                            <div>
                                Nascimento: <input type="text" name="nascimento" id="nascimento" value="<?php echo (isset($dados['nascimento']) ? $dados['nascimento'] : '') ?>" readonly><br>
                            </div>
                            <div>
                                RG: <input type="text" name="rg" id="rg" value="<?php echo (isset($dados['rg']) ? $dados['rg'] . " - " . $dados['emissor'] : '') ?>" readonly><br>
                            </div>
                            <div>
                                Graduação: <input type="text" name="graduado" id="graduado" value="<?php echo (isset($dados['graduacao']) ? $dados['graduacao'] : '') ?>" readonly><br>
                            </div>
                            <?php if (isset($_GET['curso'])) {
                                $dados1 = $curso->dados($_GET['curso']);
                            }
                            ?>
                            <div>
                                Curso: <input type="text" name="curso" id="curso" value="<?php echo (isset($dados1['name']) ? $dados1['name'] : '') ?>" readonly>
                            </div>
                            <div>
                                Tipo Curso: <input type="text" name="tipo_curso" id="tipo" value="<?php echo (isset($dados1['tipo_curso']) ? $dados1['tipo_curso'] : '') ?>" readonly>
                            </div>
                            <input type="hidden" name="c_hor_curso" value="<?php echo (isset($dados1['c_horaria']) ? $dados1['c_horaria'] : '') ?>" readonly>
                            <input type="hidden" name="ies" value="<?php echo (isset($dados1['IES']) ? $dados1['IES'] : '') ?>" readonly>
                            <input type="hidden" name="parecer" value="<?php echo (isset($dados1['parecer']) ? $dados1['parecer'] : '') ?>" readonly>
                            <input type="hidden" name="parece_curso" value="<?php echo (isset($dados1['parecer_curso']) ? $dados1['parecer_curso'] : '') ?>" readonly>

                        </div>
                        <div class="campo1">
                            <div>
                                Período: Início<input type="date" name="inicio_curso" id="inicio" required> <br>
                            </div>
                            <div>
                                Fim:<input type="date" name="fim_curso" id="fim_curso" required>
                            </div>
                            <div>
                                Data do certificado: <input type="date" name="data_certi" id="data" required>
                            </div>
                            <div>
                                Diretor(a): <br><input type="text" name="diretor" id="diretor" required>
                            </div>
                            <br>
                            <div>
                                TCC: <br><input type="text" name="tcc" id="tcc" required>
                            </div>
                        </div>
                    </div>

                </div>
                <?php $dados2 = $disciplina->ativos($_GET['curso']);
                foreach ($dados2 as $disciplina) ?>
                <table>
                    <thead>
                        <tr>
                            <th>Disciplina</th>
                            <th>Carga Horária</th>
                            <th>Frequência</th>
                            <th>Nota</th>
                            <th>Professor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados2 as $disciplina) : ?>
                            <tr>
                                <td><?= $disciplina['name'] ?>
                                    <input type="hidden" name="disc[]" value="<?= $disciplina['name'] ?>">
                                </td>
                                <td><?= $disciplina['c_h'] ?></td>
                                <input type="hidden" name="ch[]" value="<?= $disciplina['c_h'] ?>">
                                <td>
                                    <input type="number" name="freq[]" value="100" id="frequencia" required>
                                </td>
                                <td>
                                    <input type="text" name="nota[]" id="nota" required>
                                </td>
                                <td>
                                    <select name="prof[]" id="professor" required>
                                        <option value="">Selecione o professor</option>
                                        <?php foreach ($professores as $professor) : ?>
                                            <option value="<?= $professor['name'] ?>" data-titulo="<?= $professor['titulo'] ?>"><?= $professor['name'] . ' - ' . $professor['titulo'] ?> </option>

                                        <?php endforeach; ?>
                                        <input type="hidden" name="titulo[]" id="titulo_<?= $disciplina['id_disciplina'] ?>">
                                    </select>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <script>
                        $('select[name="prof[]"]').change(function() {
                            $(this).closest('tr').find('input[name="titulo[]"]').val($(this).find('option:selected').data('titulo'));
                        });
                    </script>
                </table>
                <div class="btn-tiny">
                    <div class="col-md-5">
                        <button class="btn" name="gerar" type="submit">Gerar Certificado</button>
                    </div>
                </div>

            </div>

    </div>

    </form>
    <div class="btn-tiny">
        <div class="col-md-5">
            <a href="gerarcertificado">
                <button class="btn">Voltar</button>
            </a>
        </div>
    </div>
</main>

<?php include "../Views/includes/footer.php"; ?>