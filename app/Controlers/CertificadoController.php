<?php
namespace App\Controlers;

use App\Models\Conn;
use App\Models\certificado;
use App\Controlers\Log;

require_once '../Models/Conn.php';
require_once '../Models/certificado.php';
require_once '../Controlers/Log.php';

class CertificadoController{

    private $certificado;

    public function __construct(){
        $conn = new Conn();
        $this->certificado = new certificado($conn);
    }

    public function listar(){

        return $this->certificado->listarTodos();

    }

    /**
     * Busca os certificados pelo nome do aluno ou curso.
     *
     * @param string $key Palavra chave para a busca.
     * @return array Os dados dos certificados encontrados.
     */
    public function buscar($key){
        htmlspecialchars($key);
        return $this->certificado->searchCert($key);

    }

    public function deletar($id){

        $this->certificado->deletar($id);

    }

    public function gerarCertificado(){
        $this->certificado->gerarCertificado($_POST);
    }

    public function gerarCertificadoPDF($id) {

        return $this->certificado->gerarCertificadoPDF($id);
    }

    /**
     * Troca a logotipo da escola no certificado.
     *
     * @param string $opt O tipo de logotipo a ser trocado.
     *                      - "cesa" para a logotipo da CESA.
     *                      - "essa" para a logotipo da ESSA.
     *                      - "fundo" para o fundo do certificado.
     *
     * @return void
     */
    public function trocarLogo($opt){

        $log = Log::getInstance();

        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/certificados/app/Views/img/";
        if($opt == "cesa"){
            $target_file = $target_dir . "cesa.png";
        } else if($opt == "essa"){
            $target_file = $target_dir . "essa.png";
        } else if($opt == "fundo"){
            $target_file = $target_dir . "fundo_cert.png";
        }
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["logo"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            $log->info("O arquivo não é uma imagem.");
        }
        if (file_exists($target_file)) {
            unlink($target_file);
        }
        if ($_FILES["logo"]["size"] > 50000000) {
            $uploadOk = 0;
            $log->info("O arquivo é muito grande.");
        }
        if($imageFileType != "png") {
            $uploadOk = 0;
            $log->info("O arquivo não é PNG.");
        }
        if ($uploadOk == 0) {
            $log->info("Ocorreu um erro, tente novamente.");
        } else {
            if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
                $log->info("Imagem atualizada com sucesso.");
            } else {
                $log->info("Imagem nao foi atualizada.");
            }
        }
    }

}
