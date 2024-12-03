<?php
/*
 * Esta página busca os dados no banco cert_done com o id enviado pelo usuário
 * e gera o certificado em pdf com o domPDF
 */
session_start();

use App\Controlers\CertificadoController;
use Dompdf\Dompdf;
use Dompdf\Options;

require_once '../Controlers/log.php';

use App\Controlers\Log;

$log = Log::getInstance();

if (!isset($_SESSION['nome'])) {
    header('Location: /certificados');
    exit();
}

require_once "/xampp/htdocs/certificados/vendor/autoload.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $certificado = new CertificadoController();
    $certificado_data = $certificado->gerarCertificadoPDF($id);
    $log->info('PDF gerado com sucesso: ID:' . $id . '- Aluno: ' . $certificado_data['aluno']);
    if (empty($certificado_data)) {
        echo "Variável vazia";
        exit();
    }
} else {
    header('Location: gerarcertificado');
}

$meses = array(1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
$diasdasemana = array(1 => "Segunda", 2 => "Terça", 3 => "Quarta", 4 => "Quinta", 5 => "Sexta", 6 => "Sabado", 0 => "Domingo");

$variavel = date('d/m/Y');
$variavel = str_replace('/', '-', $variavel);
$nascimento = date('d/m/Y', strtotime($certificado_data['nascimento']));

$hoje = getdate(strtotime($certificado_data['data_certi']));

$dia = $hoje["mday"];
$mes = $hoje["mon"];
$nomemes = $meses[$mes];
$ano = $hoje["year"];
$diadasemana = $hoje["wday"];
$nomediadasemana = $diasdasemana[$diadasemana];

$inicio = getdate(strtotime($certificado_data['inicio_curso']));

$diai = $inicio["mday"];
$mesi = $inicio["mon"];
$nomemesi = $meses[$mesi];
$anoi = $inicio["year"];
$diadasemana = $inicio["wday"];
$nomediadasemana = $diasdasemana[$diadasemana];

$fim = getdate(strtotime($certificado_data['fim_curso']));

$diaf = $fim["mday"];
$mesf = $fim["mon"];
$nomemesf = $meses[$mesf];
$anof = $fim["year"];
$diadasemana = $fim["wday"];
$nomediadasemana = $diasdasemana[$diadasemana];

echo "";

$date2 = $certificado_data['data_certi'];
$options = new Options();
//$options->set('font_dir', __DIR__ . 'public/fontes'); // Caminho relativo à pasta do script
$options->set(['fontDir' => 'public/fonts']);
$options->set('defaultFont', 'GreatVibes-Regular'); // Remover a extensão .ttf
$options->set('font_cache', 'cache');
$options->set('isRemoteEnabled', true);
$pdf = new Dompdf($options);
$html = "
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Certificado</title>
    <style>
    @font-face {
            font-family: 'MinhaFonte';
            src: url('data:public/font/ttf');
        }
       
            .pag1 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            background-image: url('http://localhost/certificados/app/Views/img/fundo_cert.png');
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            margin-left: -40px;
            margin-right: -40px;
            margin-bottom: -60px;
            margin-top: -40px;
            background-size: 1100px 750px;

        }
            .pag1 p{
                margin: 1rem;
            }
            .pag2 p{
                margin: 0;
            }

        .pag2 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            background-color: white;
            margin: -20;
            padding: 10px;
            }

        .registro {
            width: 80%;
            margin-left: -450px;  
            text-align: left; 
        }

        .aluno {
            width: 80%;
            margin-left: -50px;  
            text-align: left; 
              margin-top: -120px; 
              font-size: 12px;
        }
        .tcc{
            width: 150%;
            margin-left: -400px;
            margin-top: 20px;
            text-align: left;
            font-size: 16px;
        }
            .disciplinas{
                width: 180%;
                margin-left: -450px;
                text-align: left;
                font-size: 14px;
                margin-top: 20px;
            }
        table{
            border-collapse: collapse;
            width: 100%;
        }
    
        tr:nth-child(even) {
        background:lightgray;
        }

        .ies{
            font-size: 14px;
        }
        
        .logo{
            width: 70%;
            margin: 0 auto;
            padding: 10px;
        }
        .logo2{
            width: 40%;
            margin-top: -210px;
            margin-left: 300px;  
        }

        .container {
            width: 50%;
            margin: auto;
            text-align: center;
            margin-left: 43%;
        }
        .content {
            width: 100%;
            margin-left: 20px;
        }
    
        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            font-family: 'GreatVibes-Regular';
        }
        .cert-text {
            font-size: 16px;
        }
        .cert-name {
            font-size: 26px;
            font-weight: bold;
            font-family: 'MinhaFonte';

       }
        .cert-title {
           font-size: 16px;
        }
        .cert-school {
           font-size: 16px; 
        }
        .cert-date {
           font-size: 16px;
        }
        .footer {
           text-align: center;
        }
    </style></head>

<body>
<div class='pag1'>
        <div class='container'>
            <div class='content'>
                ";
if ($certificado_data['ies'] == 'Centro de Ensino Superior de Arcoverde')
    $html .= "
                <br>
                <img class='logo' src='http://localhost/certificados/app/Views/img/cesa.png' alt='CESA - Centro de Ensino Superior de Arcoverde'>
                <div>
                <div class='title'>
                    <h1>CERTIFICADO</h1>
                </div>
                <div>
                        <p class='cert-text'>A Diretora do $certificado_data[ies] confere a</p>
                        <p class='cert-name'>$certificado_data[aluno]</p>
                        <p class='cert-title'>Certificado do Curso de $certificado_data[tipo_curso] em</p>
                        <p class='cert-name'>$certificado_data[curso]</p>
                        <p class='cert-school'>no Nível Especialização, com $certificado_data[c_hor_curso] horas-aula, no período de</p>
                        <p class='cert-ies'> $diai de $nomemesi de $anoi à $diaf de $nomemesf de $anof.</p>
                    </div>    
                </div>
            </div>

            <div class='footer'>
                <p class='cert-date'>Arcoverde, $dia de $nomemes de $ano</p>
            </div>
            <div class='footer'>
                <p class='cert-date'>$certificado_data[diretor]</p>
                <p class='cert-date'>Diretor(a)</p><br><br><br>
            </div>
        </div>

    </body>

    </html>
                ";
elseif ($certificado_data['ies'] == 'Escola Superior de Saúde de Arcoverde')
    $html .= "
                <br>
                <img class='logo' src='http://localhost/certificados/app/Views/img/essa.png' alt='ESSA - Escola Superior de Saúde de Arcoverde'>
                <div class='cert'>
                <div class='title'>
                    <h1>CERTIFICADO</h1>
                </div>
                <div>
                        <p class='cert-text'>A Diretora do $certificado_data[ies] confere a</p>
                        <p class='cert-name'>$certificado_data[aluno]</p>
                        <p class='cert-title'>Certificado do Curso de $certificado_data[tipo_curso] em</p>
                        <p class='cert-name'>$certificado_data[curso]</p>
                        <p class='cert-school'>no Nível Especialização, com $certificado_data[c_hor_curso] horas-aula, no período de</p>
                        <p class='cert-ies'> $diai de $nomemesi de $anoi à $diaf de $nomemesf de $anof.</p>
                    </div>    
                </div>
            </div>

            <div class='footer'>
                <p class='cert-date'>Arcoverde, $dia de $nomemes de $ano</p>
            </div>
            <div class='footer'>
                <p class='cert-date'>$certificado_data[diretor]</p>
                <p class='cert-date'>Diretor(a)</p><br><br><br>
            </div>
        </div>
        </body>

    </html>
</div>";

$html .=
    "

    <div class='pag2'>
        <div class='container'>
            <div class='content'>
                <div class='registro'>
                    <div>
                        <p> Média mínima de aprovação: 7,0 </p>
                        <p> Frequência mínima para aprovação: 75% </p>
                        <br>
                        <p class='ies'><strong> $certificado_data[ies] </strong> </p>
                        <p> Instituição credenciada pelo Parecer $certificado_data[parecer] </p>
                        <br>
                        <p> Certificado registrado de acordo com a </p>
                        <p> Resolução CEE/PE Nº 01 de 02 de junho de 2003 e</p>
                        <p> Resolução CNE/CES Nº 01 de 08 de junho de 2007.</p>
                        <p> Curso aprovado pelo Parecer $certificado_data[parece_curso]</p>
                        <br>
                        <p> Registro Nº: ____________________________________ </p>
                        <br>
                        <p> Livro Nº _____________ Folha Nº _________________ </p>
                        <br>
                        <p> Arcoverde/PE, _______ de _____________ de 20_____ </p> 
                    </div>    
                </div> ";
if ($certificado_data['ies'] == 'Centro de Ensino Superior de Arcoverde')
    $html .= "
    <img class='logo2' src='http://localhost/certificados/app/Views/img/cesa.png' alt='CESA - Centro de Ensino Superior de Arcoverde'>
";
elseif ($certificado_data['ies'] == 'Escola Superior de Saúde de Arcoverde') {
    $html .=
        "<img class='logo2' src='http://localhost/certificados/app/Views/img/essa.png' alt='ESSA - Escola Superior de Saúde de Arcoverde'>
     ";
}
$html .= "
                <div class='aluno'>
                <strong>
                    <p>Nome: $certificado_data[aluno]</p>
                    <p>Nacionalidade: $certificado_data[nacionalidade]</p>
                    <p>Natural de: $certificado_data[naturalidade]</p>
                    <p>Filiação: $certificado_data[pai] e</p>
                    <p>$certificado_data[mae]</p>
                    <p>Data de Nascimento: $nascimento</p>
                    <p>Documento de Identificação: RG Nº $certificado_data[rg]</p>
                    <p>Graduado(a) em: $certificado_data[graduado]</p></strong>
                </div>

                <div class='tcc'>
                <strong> 
                    <p> Trabalho de Conclusão de Curso: $certificado_data[tcc] </p>  
                </strong> 
                </div>
                <div class='disciplinas'>
                <table>
                    <tr>
                        <th>Diciplina</th>
                        <th>CH</th>
                        <th>Frequência</th>
                        <th>Nota</th>
                        <th>Corpo Docente</th>
                        <th>Titulação</th>
                    </tr>
                ";
for ($i = 1; $i < 18; $i++) {
    $html .= "
                    <tr>
                        <td> " . $certificado_data['disc' . $i] . " </td>
                        <td> " . $certificado_data['ch' . $i] . " </td>
                        <td> ";
    if (!empty($certificado_data['freq' . $i])) {
        $html .= "
                             " . $certificado_data['freq' . $i] . " %
                         ";
    }
    $html .= "
                        </td>
                        <td> " . $certificado_data['nota' . $i] . " </td>
                        <td> " . $certificado_data['prof' . $i] . " </td>
                        <td> " . $certificado_data['titulo' . $i] . " </td>
                    </tr>
                ";
}
$html .= "
                    
                </table>

            </div>
        </div>
    </div>
</body>
               

</html>";
$pdf->loadHtml($html);
$pdf->setPaper('A4', 'landscape');
$pdf->render();
header('Content-type: application/pdf');
$pdf->stream(
    'Certificado_' . $certificado_data['aluno'] . '_' . $certificado_data['curso'],
    array('Attachment' => true)
);
