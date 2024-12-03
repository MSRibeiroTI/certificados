<?php

namespace App\Models;

use Spatie\DbDumper\Databases\MySql;

require '/xampp/htdocs/certificados/vendor/autoload.php';

require '/xampp/htdocs/certificados/vendor/spatie/db-dumper/src/DbDumper.php';
require_once '../Controlers/log.php';

use App\Controlers\Log;

use Exception;
use ZipArchive;

class backup {
    private static $instance;

    private function __construct() {
    }

    /**
     * Singleton: Retorna a única instância da classe.
     *
     * @return static
     */
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Gera um backup do banco de dados SISCERT
     *
     * O backup será salvo em um arquivo zip com o nome "backup_siscert_<data e hora atual>.zip"
     * e será disponibilizado para download
     *
     * @throws Exception
     */
    public function backup() {
        try {
            $filePath = '../backup/' . date('YmdHis') . '.sql';

            MySql::create()
                ->setDumpBinaryPath('C:\Program Files\MySQL\MySQL Server 8.0\bin')
                ->setPort(3306)
                ->setHost('localhost')
                ->setUsername('root')
                ->setPassword('marcelo81')
                ->setDbName('siscert')
                ->dumpToFile($filePath);

            $zipFilePath = '../backup/' . 'backup_siscert_' . date('YmdHis') . '.zip';

            $zip = new ZipArchive();
            $zip->open($zipFilePath, ZipArchive::CREATE);
            $zip->addFile($filePath, basename($filePath));
            $zip->close();

            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . basename($zipFilePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($zipFilePath));

            readfile($zipFilePath);
            $log = Log::getInstance();

            $log->info('Backup gerado com sucesso!');
            exit;

            

            echo "<script>alert('Backup gerado com sucesso!')</script>";
            echo "<script>window.location.href = 'config'</script>";
        } catch (Exception $e) {
            $log = Log::getInstance();
            $log->info('Erro ao gerar backup: ' . $e->getMessage());
            echo 'Erro ao gerar backup: ' . $e->getMessage();
        }
    }
}