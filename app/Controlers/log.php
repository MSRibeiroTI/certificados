<?php
namespace App\Controlers;

class Log {
    private static $instance;
    private $file;

    /**
     * Inicializa o arquivo de log.
     *
     * @throws \Exception
     */
    private function __construct() {
        $this->file = fopen(dirname(__DIR__, 2) . '/siscert_log.txt', 'a');
        if (!$this->file) {
            touch(dirname(__DIR__, 2) . '/siscert_log.txt');
            $this->file = fopen(dirname(__DIR__, 2) . '/siscert_log.txt', 'a');
            if (!$this->file) {
                throw new \Exception('Não foi possível criar o arquivo de log');
            }
        }
    }

    /**
     * Retorna a instância única do arquivo de log.
     *
     * @return Log
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new Log();
        }

        return self::$instance;
    }

    /**
     * Registra um log de informação.
     *
     * @param string $message A mensagem a ser registrada.
     */
    public function info($message) {
        $user = $_SESSION['nome'] ?? '';
        $date = date('d/m/Y H:i:s');
        $ip = $_SESSION['ip'] ?? $_SERVER['REMOTE_ADDR'];
        fwrite($this->file, "$date - $ip - $user - $message\n");
    }

    public function __destruct() {
        fclose($this->file);
    }
}

