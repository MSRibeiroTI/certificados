<?php

namespace App\Models;

require_once '../Models/Conn.php';

use App\Models\Conn;
use PDO;
use Exception;
use PDOException;

class certificado extends Conn
{

    private $conn;


    public function __construct(Conn $conn)
    {
        $this->conn = $conn;
    }

    public function listarTodos()
    {

        $sql = "SELECT  id_cert_done, curso, aluno, data_certi FROM cert_done";
        $stmt = $this->conn->connect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deletar($id) {

        $sql = "DELETE FROM cert_done WHERE id_cert_done = :id";

        $stmt = $this->conn->connect->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    }

    /**
     * Retorna um array associativo com os dados do certificado
     * a ser gerado em PDF, com base no id do certificado.
     *
     * @param int $id ID do certificado
     *
     * @return array Dados do certificado
     */
    public function gerarCertificadoPDF($id){

        $sql = "SELECT * FROM cert_done WHERE id_cert_done = $id";

        $stmt = $this->conn->connect->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Retorna um array associativo com os dados dos certificados
     * que atendem ao critério de busca.
     *
     * @param string $key Palavra chave para a busca
     *
     * @return array Certificados que atendem ao critério de busca
     */
    public function searchCert($key){
        $sql = "SELECT * FROM cert_done WHERE curso LIKE '%$key%' OR aluno LIKE '%$key%'";
        $stmt = $this->conn->connect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    /**
     * Insere todos os dados do certificado.
     *
     * 
     */
    public function gerarCertificado()
    {
        $curso = $_POST['curso'];
        $tipo_curso = $_POST['tipo_curso'];
        $c_h = $_POST['c_hor_curso'];
        $inicio = $_POST['inicio_curso'];
        $fim = $_POST['fim_curso'];
        $data = $_POST['data_certi'];
        $diretor = $_POST['diretor'];
        $ies = $_POST['ies'];
        $parecer = $_POST['parecer'];
        $parecer_curso = $_POST['parece_curso'];
        $aluno = $_POST['aluno'];
        $nacionalidade = $_POST['nacionalidade'];
        $naturalidade = $_POST['naturalidade'];
        $pai = $_POST['pai'];
        $mae = $_POST['mae'];
        $rg = $_POST['rg'];
        $nascimento = $_POST['nascimento'];
        $graduado = $_POST['graduado'];
        $tcc = $_POST['tcc'];
        $disc1 = (isset($_POST['disc'][0]) ? $_POST['disc'][0] : null);
        $disc2 = (isset($_POST['disc'][1]) ? $_POST['disc'][1] : null);
        $disc3 = (isset($_POST['disc'][2]) ? $_POST['disc'][2] : null);
        $disc4 = (isset($_POST['disc'][3]) ? $_POST['disc'][3] : null);
        $disc5 = (isset($_POST['disc'][4]) ? $_POST['disc'][4] : null);
        $disc6 = (isset($_POST['disc'][5]) ? $_POST['disc'][5] : null);
        $disc7 = (isset($_POST['disc'][6]) ? $_POST['disc'][6] : null);
        $disc8 = (isset($_POST['disc'][7]) ? $_POST['disc'][7] : null);
        $disc9 = (isset($_POST['disc'][8]) ? $_POST['disc'][8] : null);
        $disc10 = (isset($_POST['disc'][9]) ? $_POST['disc'][9] : null);
        $disc11 = (isset($_POST['disc'][10]) ? $_POST['disc'][10] : null);
        $disc12 = (isset($_POST['disc'][11]) ? $_POST['disc'][11] : null);
        $disc13 = (isset($_POST['disc'][12]) ? $_POST['disc'][12] : null);
        $disc14 = (isset($_POST['disc'][13]) ? $_POST['disc'][13] : null);
        $disc15 = (isset($_POST['disc'][14]) ? $_POST['disc'][14] : null);
        $disc16 = (isset($_POST['disc'][15]) ? $_POST['disc'][15] : null);
        $disc17 = (isset($_POST['disc'][16]) ? $_POST['disc'][16] : null);
        $ch1 = (isset($_POST['ch'][0]) ? $_POST['ch'][0] : null);
        $ch2 = (isset($_POST['ch'][1]) ? $_POST['ch'][1] : null);
        $ch3 = (isset($_POST['ch'][2]) ? $_POST['ch'][2] : null);
        $ch4 = (isset($_POST['ch'][3]) ? $_POST['ch'][3] : null);
        $ch5 = (isset($_POST['ch'][4]) ? $_POST['ch'][4] : null);
        $ch6 = (isset($_POST['ch'][5]) ? $_POST['ch'][5] : null);
        $ch7 = (isset($_POST['ch'][6]) ? $_POST['ch'][6] : null);
        $ch8 = (isset($_POST['ch'][7]) ? $_POST['ch'][7] : null);
        $ch9 = (isset($_POST['ch'][8]) ? $_POST['ch'][8] : null);
        $ch10 = (isset($_POST['ch'][9]) ? $_POST['ch'][9] : null);
        $ch11 = (isset($_POST['ch'][10]) ? $_POST['ch'][10] : null);
        $ch12 = (isset($_POST['ch'][11]) ? $_POST['ch'][11] : null);
        $ch13 = (isset($_POST['ch'][12]) ? $_POST['ch'][12] : null);
        $ch14 = (isset($_POST['ch'][13]) ? $_POST['ch'][13] : null);
        $ch15 = (isset($_POST['ch'][14]) ? $_POST['ch'][14] : null);
        $ch16 = (isset($_POST['ch'][15]) ? $_POST['ch'][15] : null);
        $ch17 = (isset($_POST['ch'][16]) ? $_POST['ch'][16] : null);
        $freq1 = (isset($_POST['freq'][0]) ? $_POST['freq'][0] : null);
        $freq2 = (isset($_POST['freq'][1]) ? $_POST['freq'][1] : null);
        $freq3 = (isset($_POST['freq'][2]) ? $_POST['freq'][2] : null);
        $freq4 = (isset($_POST['freq'][3]) ? $_POST['freq'][3] : null);
        $freq5 = (isset($_POST['freq'][4]) ? $_POST['freq'][4] : null);
        $freq6 = (isset($_POST['freq'][5]) ? $_POST['freq'][5] : null);
        $freq7 = (isset($_POST['freq'][6]) ? $_POST['freq'][6] : null);
        $freq8 = (isset($_POST['freq'][7]) ? $_POST['freq'][7] : null);
        $freq9 = (isset($_POST['freq'][8]) ? $_POST['freq'][8] : null);
        $freq10 = (isset($_POST['freq'][9]) ? $_POST['freq'][9] : null);
        $freq11 = (isset($_POST['freq'][10]) ? $_POST['freq'][10] : null);
        $freq12 = (isset($_POST['freq'][11]) ? $_POST['freq'][11] : null);
        $freq13 = (isset($_POST['freq'][12]) ? $_POST['freq'][12] : null);
        $freq14 = (isset($_POST['freq'][13]) ? $_POST['freq'][13] : null);
        $freq15 = (isset($_POST['freq'][14]) ? $_POST['freq'][14] : null);
        $freq16 = (isset($_POST['freq'][15]) ? $_POST['freq'][15] : null);
        $freq17 = (isset($_POST['freq'][16]) ? $_POST['freq'][16] : null);
        $nota1 = (isset($_POST['nota'][0]) ? $_POST['nota'][0] : null);
        $nota2 = (isset($_POST['nota'][1]) ? $_POST['nota'][1] : null);
        $nota3 = (isset($_POST['nota'][2]) ? $_POST['nota'][2] : null);
        $nota4 = (isset($_POST['nota'][3]) ? $_POST['nota'][3] : null);
        $nota5 = (isset($_POST['nota'][4]) ? $_POST['nota'][4] : null);
        $nota6 = (isset($_POST['nota'][5]) ? $_POST['nota'][5] : null);
        $nota7 = (isset($_POST['nota'][6]) ? $_POST['nota'][6] : null);
        $nota8 = (isset($_POST['nota'][7]) ? $_POST['nota'][7] : null);
        $nota9 = (isset($_POST['nota'][8]) ? $_POST['nota'][8] : null);
        $nota10 = (isset($_POST['nota'][9]) ? $_POST['nota'][9] : null);
        $nota11 = (isset($_POST['nota'][10]) ? $_POST['nota'][10] : null);
        $nota12 = (isset($_POST['nota'][11]) ? $_POST['nota'][11] : null);
        $nota13 = (isset($_POST['nota'][12]) ? $_POST['nota'][12] : null);
        $nota14 = (isset($_POST['nota'][13]) ? $_POST['nota'][13] : null);
        $nota15 = (isset($_POST['nota'][14]) ? $_POST['nota'][14] : null);
        $nota16 = (isset($_POST['nota'][15]) ? $_POST['nota'][15] : null);
        $nota17 = (isset($_POST['nota'][16]) ? $_POST['nota'][16] : null);
        $prof1 = (isset($_POST['prof'][0]) ? $_POST['prof'][0] : null);
        $prof2 = (isset($_POST['prof'][1]) ? $_POST['prof'][1] : null);
        $prof3 = (isset($_POST['prof'][2]) ? $_POST['prof'][2] : null);
        $prof4 = (isset($_POST['prof'][3]) ? $_POST['prof'][3] : null);
        $prof5 = (isset($_POST['prof'][4]) ? $_POST['prof'][4] : null);
        $prof6 = (isset($_POST['prof'][5]) ? $_POST['prof'][5] : null);
        $prof7 = (isset($_POST['prof'][6]) ? $_POST['prof'][6] : null);
        $prof8 = (isset($_POST['prof'][7]) ? $_POST['prof'][7] : null);
        $prof9 = (isset($_POST['prof'][8]) ? $_POST['prof'][8] : null);
        $prof10 = (isset($_POST['prof'][9]) ? $_POST['prof'][9] : null);
        $prof11 = (isset($_POST['prof'][10]) ? $_POST['prof'][10] : null);
        $prof12 = (isset($_POST['prof'][11]) ? $_POST['prof'][11] : null);
        $prof13 = (isset($_POST['prof'][12]) ? $_POST['prof'][12] : null);
        $prof14 = (isset($_POST['prof'][13]) ? $_POST['prof'][13] : null);
        $prof15 = (isset($_POST['prof'][14]) ? $_POST['prof'][14] : null);
        $prof16 = (isset($_POST['prof'][15]) ? $_POST['prof'][15] : null);
        $prof17 = (isset($_POST['prof'][16]) ? $_POST['prof'][16] : null);
        $titulo1 = (isset($_POST['titulo'][0]) ? $_POST['titulo'][0] : null);
        $titulo2 = (isset($_POST['titulo'][1]) ? $_POST['titulo'][1] : null);
        $titulo3 = (isset($_POST['titulo'][2]) ? $_POST['titulo'][2] : null);
        $titulo4 = (isset($_POST['titulo'][3]) ? $_POST['titulo'][3] : null);
        $titulo5 = (isset($_POST['titulo'][4]) ? $_POST['titulo'][4] : null);
        $titulo6 = (isset($_POST['titulo'][5]) ? $_POST['titulo'][5] : null);
        $titulo7 = (isset($_POST['titulo'][6]) ? $_POST['titulo'][6] : null);
        $titulo8 = (isset($_POST['titulo'][7]) ? $_POST['titulo'][7] : null);
        $titulo9 = (isset($_POST['titulo'][8]) ? $_POST['titulo'][8] : null);
        $titulo10 = (isset($_POST['titulo'][9]) ? $_POST['titulo'][9] : null);
        $titulo11 = (isset($_POST['titulo'][10]) ? $_POST['titulo'][10] : null);
        $titulo12 = (isset($_POST['titulo'][11]) ? $_POST['titulo'][11] : null);
        $titulo13 = (isset($_POST['titulo'][12]) ? $_POST['titulo'][12] : null);
        $titulo14 = (isset($_POST['titulo'][13]) ? $_POST['titulo'][13] : null);
        $titulo15 = (isset($_POST['titulo'][14]) ? $_POST['titulo'][14] : null);
        $titulo16 = (isset($_POST['titulo'][15]) ? $_POST['titulo'][15] : null);
        $titulo17 = (isset($_POST['titulo'][16]) ? $_POST['titulo'][16] : null);            

        try {
            $sql = "INSERT INTO cert_done (
                 curso, tipo_curso, c_hor_curso, inicio_curso, fim_curso, data_certi, diretor, ies, parecer, parece_curso, 
                 aluno, nacionalidade, naturalidade, pai, mae, nascimento, rg, graduado, tcc,
                 disc1, disc2, disc3, disc4, disc5, disc6, disc7, disc8, disc9, disc10, disc11, disc12, disc13, disc14, disc15, disc16, disc17,
                 ch1, ch2, ch3, ch4, ch5, ch6, ch7, ch8, ch9, ch10, ch11, ch12, ch13, ch14, ch15, ch16, ch17,
                 freq1, freq2, freq3, freq4, freq5, freq6, freq7, freq8, freq9, freq10, freq11, freq12, freq13, freq14, freq15, freq16, freq17,
                 nota1, nota2, nota3, nota4, nota5, nota6, nota7, nota8, nota9, nota10, nota11, nota12, nota13, nota14, nota15, nota16, nota17,
                 prof1, prof2, prof3, prof4, prof5, prof6, prof7, prof8, prof9, prof10, prof11, prof12, prof13, prof14, prof15, prof16, prof17,
                 titulo1, titulo2, titulo3, titulo4, titulo5, titulo6, titulo7, titulo8, titulo9, titulo10, titulo11, titulo12, titulo13, titulo14, titulo15, titulo16, titulo17)
                 VALUES (:curso, :tipo_curso, :c_h, :inicio, :fim, :data, :diretor, :ies, :parecer, :parecer_curso,
                 :aluno, :nacionalidade, :naturalidade, :pai, :mae, :nascimento, :rg, :graduado, :tcc, 
                 :disc1, :disc2, :disc3, :disc4, :disc5, :disc6, :disc7, :disc8, :disc9, :disc10, :disc11, :disc12, :disc13, :disc14, :disc15, :disc16, :disc17,
                 :ch1, :ch2, :ch3, :ch4, :ch5, :ch6, :ch7, :ch8, :ch9, :ch10, :ch11, :ch12, :ch13, :ch14, :ch15, :ch16, :ch17,
                 :freq1, :freq2, :freq3, :freq4, :freq5, :freq6, :freq7, :freq8, :freq9, :freq10, :freq11, :freq12, :freq13, :freq14, :freq15, :freq16, :freq17,
                 :nota1, :nota2, :nota3, :nota4, :nota5, :nota6, :nota7, :nota8, :nota9, :nota10, :nota11, :nota12, :nota13, :nota14, :nota15, :nota16, :nota17,
                 :prof1, :prof2, :prof3, :prof4, :prof5, :prof6, :prof7, :prof8, :prof9, :prof10, :prof11, :prof12, :prof13, :prof14, :prof15, :prof16, :prof17,
                 :titulo1, :titulo2, :titulo3, :titulo4, :titulo5, :titulo6, :titulo7, :titulo8, :titulo9, :titulo10, :titulo11, :titulo12, :titulo13, :titulo14, :titulo15, :titulo16, :titulo17)";
            $stmt = $this->conn->connect->prepare($sql);
            $stmt->bindParam(':curso', $curso, PDO::PARAM_STR);
            $stmt->bindParam(':tipo_curso', $tipo_curso, PDO::PARAM_STR);
            $stmt->bindParam(':c_h', $c_h, PDO::PARAM_STR);
            $stmt->bindParam(':inicio', $inicio, PDO::PARAM_STR);
            $stmt->bindParam(':fim', $fim, PDO::PARAM_STR);
            $stmt->bindParam(':data', $data, PDO::PARAM_STR);
            $stmt->bindParam(':diretor', $diretor, PDO::PARAM_STR);
            $stmt->bindParam(':ies', $ies, PDO::PARAM_STR);
            $stmt->bindParam(':parecer', $parecer, PDO::PARAM_STR);
            $stmt->bindParam(':parecer_curso', $parecer_curso, PDO::PARAM_STR);
            $stmt->bindParam(':aluno', $aluno, PDO::PARAM_STR);
            $stmt->bindParam(':nacionalidade', $nacionalidade, PDO::PARAM_STR);
            $stmt->bindParam(':naturalidade', $naturalidade, PDO::PARAM_STR);
            $stmt->bindParam(':pai', $pai, PDO::PARAM_STR);
            $stmt->bindParam(':mae', $mae, PDO::PARAM_STR);
            $stmt->bindParam(':nascimento', $nascimento, PDO::PARAM_STR);
            $stmt->bindParam(':rg', $rg, PDO::PARAM_STR);
            $stmt->bindParam(':graduado', $graduado, PDO::PARAM_STR);
            $stmt->bindParam(':tcc', $tcc, PDO::PARAM_STR);
            $stmt->bindParam(':disc1', $disc1, PDO::PARAM_STR);
            $stmt->bindParam(':disc2', $disc2, PDO::PARAM_STR);
            $stmt->bindParam(':disc3', $disc3, PDO::PARAM_STR);
            $stmt->bindParam(':disc4', $disc4, PDO::PARAM_STR);
            $stmt->bindParam(':disc5', $disc5, PDO::PARAM_STR);
            $stmt->bindParam(':disc6', $disc6, PDO::PARAM_STR);
            $stmt->bindParam(':disc7', $disc7, PDO::PARAM_STR);
            $stmt->bindParam(':disc8', $disc8, PDO::PARAM_STR);
            $stmt->bindParam(':disc9', $disc9, PDO::PARAM_STR);
            $stmt->bindParam(':disc10', $disc10, PDO::PARAM_STR);
            $stmt->bindParam(':disc11', $disc11, PDO::PARAM_STR);
            $stmt->bindParam(':disc12', $disc12, PDO::PARAM_STR);
            $stmt->bindParam(':disc13', $disc13, PDO::PARAM_STR);
            $stmt->bindParam(':disc14', $disc14, PDO::PARAM_STR);
            $stmt->bindParam(':disc15', $disc15, PDO::PARAM_STR);
            $stmt->bindParam(':disc16', $disc16, PDO::PARAM_STR);
            $stmt->bindParam(':disc17', $disc17, PDO::PARAM_STR);
            $stmt->bindParam(':ch1', $ch1, PDO::PARAM_INT);
            $stmt->bindParam(':ch2', $ch2, PDO::PARAM_INT);
            $stmt->bindParam(':ch3', $ch3, PDO::PARAM_INT);
            $stmt->bindParam(':ch4', $ch4, PDO::PARAM_INT);
            $stmt->bindParam(':ch5', $ch5, PDO::PARAM_INT);
            $stmt->bindParam(':ch6', $ch6, PDO::PARAM_INT);
            $stmt->bindParam(':ch7', $ch7, PDO::PARAM_INT);
            $stmt->bindParam(':ch8', $ch8, PDO::PARAM_INT);
            $stmt->bindParam(':ch9', $ch9, PDO::PARAM_INT);
            $stmt->bindParam(':ch10', $ch10, PDO::PARAM_INT);
            $stmt->bindParam(':ch11', $ch11, PDO::PARAM_INT);
            $stmt->bindParam(':ch12', $ch12, PDO::PARAM_INT);
            $stmt->bindParam(':ch13', $ch13, PDO::PARAM_INT);
            $stmt->bindParam(':ch14', $ch14, PDO::PARAM_INT);
            $stmt->bindParam(':ch15', $ch15, PDO::PARAM_INT);
            $stmt->bindParam(':ch16', $ch16, PDO::PARAM_INT);
            $stmt->bindParam(':ch17', $ch17, PDO::PARAM_INT);
            $stmt->bindParam(':freq1', $freq1, PDO::PARAM_STR);
            $stmt->bindParam(':freq2', $freq2, PDO::PARAM_STR);
            $stmt->bindParam(':freq3', $freq3, PDO::PARAM_STR);
            $stmt->bindParam(':freq4', $freq4, PDO::PARAM_STR);
            $stmt->bindParam(':freq5', $freq5, PDO::PARAM_STR);
            $stmt->bindParam(':freq6', $freq6, PDO::PARAM_STR);
            $stmt->bindParam(':freq7', $freq7, PDO::PARAM_STR);
            $stmt->bindParam(':freq8', $freq8, PDO::PARAM_STR);
            $stmt->bindParam(':freq9', $freq9, PDO::PARAM_STR);
            $stmt->bindParam(':freq10', $freq10, PDO::PARAM_STR);
            $stmt->bindParam(':freq11', $freq11, PDO::PARAM_STR);
            $stmt->bindParam(':freq12', $freq12, PDO::PARAM_STR);
            $stmt->bindParam(':freq13', $freq13, PDO::PARAM_STR);
            $stmt->bindParam(':freq14', $freq14, PDO::PARAM_STR);
            $stmt->bindParam(':freq15', $freq15, PDO::PARAM_STR);
            $stmt->bindParam(':freq16', $freq16, PDO::PARAM_STR);
            $stmt->bindParam(':freq17', $freq17, PDO::PARAM_STR);
            $stmt->bindParam(':nota1', $nota1, PDO::PARAM_STR);
            $stmt->bindParam(':nota2', $nota2, PDO::PARAM_STR);
            $stmt->bindParam(':nota3', $nota3, PDO::PARAM_STR);
            $stmt->bindParam(':nota4', $nota4, PDO::PARAM_STR);
            $stmt->bindParam(':nota5', $nota5, PDO::PARAM_STR);
            $stmt->bindParam(':nota6', $nota6, PDO::PARAM_STR);
            $stmt->bindParam(':nota7', $nota7, PDO::PARAM_STR);
            $stmt->bindParam(':nota8', $nota8, PDO::PARAM_STR);
            $stmt->bindParam(':nota9', $nota9, PDO::PARAM_STR);
            $stmt->bindParam(':nota10', $nota10, PDO::PARAM_STR);
            $stmt->bindParam(':nota11', $nota11, PDO::PARAM_STR);
            $stmt->bindParam(':nota12', $nota12, PDO::PARAM_STR);
            $stmt->bindParam(':nota13', $nota13, PDO::PARAM_STR);
            $stmt->bindParam(':nota14', $nota14, PDO::PARAM_STR);
            $stmt->bindParam(':nota15', $nota15, PDO::PARAM_STR);
            $stmt->bindParam(':nota16', $nota16, PDO::PARAM_STR);
            $stmt->bindParam(':nota17', $nota17, PDO::PARAM_STR);
            $stmt->bindParam(':prof1', $prof1, PDO::PARAM_STR);
            $stmt->bindParam(':prof2', $prof2, PDO::PARAM_STR);
            $stmt->bindParam(':prof3', $prof3, PDO::PARAM_STR);
            $stmt->bindParam(':prof4', $prof4, PDO::PARAM_STR);
            $stmt->bindParam(':prof5', $prof5, PDO::PARAM_STR);
            $stmt->bindParam(':prof6', $prof6, PDO::PARAM_STR);
            $stmt->bindParam(':prof7', $prof7, PDO::PARAM_STR);
            $stmt->bindParam(':prof8', $prof8, PDO::PARAM_STR);
            $stmt->bindParam(':prof9', $prof9, PDO::PARAM_STR);
            $stmt->bindParam(':prof10', $prof10, PDO::PARAM_STR);
            $stmt->bindParam(':prof11', $prof11, PDO::PARAM_STR);
            $stmt->bindParam(':prof12', $prof12, PDO::PARAM_STR);
            $stmt->bindParam(':prof13', $prof13, PDO::PARAM_STR);
            $stmt->bindParam(':prof14', $prof14, PDO::PARAM_STR);
            $stmt->bindParam(':prof15', $prof15, PDO::PARAM_STR);
            $stmt->bindParam(':prof16', $prof16, PDO::PARAM_STR);
            $stmt->bindParam(':prof17', $prof17, PDO::PARAM_STR);
            $stmt->bindParam(':titulo1', $titulo1, PDO::PARAM_STR);
            $stmt->bindParam(':titulo2', $titulo2, PDO::PARAM_STR);
            $stmt->bindParam(':titulo3', $titulo3, PDO::PARAM_STR);
            $stmt->bindParam(':titulo4', $titulo4, PDO::PARAM_STR);
            $stmt->bindParam(':titulo5', $titulo5, PDO::PARAM_STR);
            $stmt->bindParam(':titulo6', $titulo6, PDO::PARAM_STR);
            $stmt->bindParam(':titulo7', $titulo7, PDO::PARAM_STR);
            $stmt->bindParam(':titulo8', $titulo8, PDO::PARAM_STR);
            $stmt->bindParam(':titulo9', $titulo9, PDO::PARAM_STR);
            $stmt->bindParam(':titulo10', $titulo10, PDO::PARAM_STR);
            $stmt->bindParam(':titulo11', $titulo11, PDO::PARAM_STR);
            $stmt->bindParam(':titulo12', $titulo12, PDO::PARAM_STR);
            $stmt->bindParam(':titulo13', $titulo13, PDO::PARAM_STR);
            $stmt->bindParam(':titulo14', $titulo14, PDO::PARAM_STR);
            $stmt->bindParam(':titulo15', $titulo15, PDO::PARAM_STR);
            $stmt->bindParam(':titulo16', $titulo16, PDO::PARAM_STR);
            $stmt->bindParam(':titulo17', $titulo17, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar aluno" . $e->getMessage();
        }

        
    }
}

      

