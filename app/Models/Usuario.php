<?php

namespace App\Models;


require_once '../Models/Conn.php';

use App\Models\Conn;
use Exception;


class Usuario extends Conn{
    private $conn;
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $perfil;

    public function __construct(Conn $conn){
        $this->conn = $conn;
    }

    public function getId(): int
    {
        
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function getPerfil(): string
    {
        return $this->perfil;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setSenha(string $senha): void
    {
        $this->senha = $senha;
    }

    public function setPerfil(string $perfil): void
    {
        $this->perfil = $perfil;
    }

    /**
     * Realiza o login do usu rio no sistema.
     *
     * @param string $email E-mail do usu rio.
     * @param string $senha Senha do usu rio.
     * @return bool Verdadeiro se o login for bem-sucedido, falso caso contr rio.
     */
    public function login(string $email, string $senha): bool
    {
        $senha = hash('sha256', $senha);
        htmlspecialchars($email);
        htmlspecialchars($senha);
        $stmt = $this->conn->connect->prepare('SELECT * FROM users WHERE email = :email AND password = :senha');
        $stmt->execute(['email' => $email, 'senha' => $senha]);

        if ($stmt->rowCount() > 0) {
            $name = $stmt->fetch(\PDO::FETCH_ASSOC);
            $_SESSION['nome'] = $name['name'];
            $_SESSION['email'] = $name['email'];
            $_SESSION['id'] = $name['id_user'];
            $_SESSION['perfil'] = $name['perfil'];
            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];

            return true;
        }

        return false;
    }

    /**
     * Cadastra um novo usu rio no banco de dados.
     *
     * @param string $nome Nome do usu rio.
     * @param string $email E-mail do usu rio.
     * @param string $senha Senha do usu rio.
     * @param string $perfil Perfil do usu rio (1 para usu rio, 2 para administrador).
     *
     * @throws Exception Lança uma exceção se houver algum erro na execução da query de cadastro caso o cadastro não seja bem-sucedido.
     */
    public function cadastrar(string $nome, string $email, string $senha, string $perfil)
    {
        try{
        $senha = hash('sha256', $senha);
        $stmt = $this->conn->connect->prepare("INSERT INTO users (name, email, password, perfil) VALUES (:nome, :email, :senha, :perfil)");
        $stmt->execute(['nome' => $nome, 'email' => $email, 'senha' => $senha, 'perfil' => $perfil]);
        }
        catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Retorna todos os usu rios cadastrados no banco de dados.
     * 
     * @return array Todos os usu rios cadastrados.
     */
    public function listarTodos(){
        $stmt = $this->conn->connect->prepare('SELECT * FROM users');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

    public function deletar($id){
        $stmt = $this->conn->connect->prepare('DELETE FROM users WHERE id_user = :id');
        $stmt->execute(['id' => $id]);
    }

    public function editar($id){

        $stmt = $this->conn->connect->prepare('SELECT * FROM users WHERE id_user = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function updUser($nome, $id, $email, $perfil){
        $stmt = $this->conn->connect->prepare('UPDATE users SET name = :nome, email = :email, perfil = :perfil WHERE id_user = :id');
        $stmt->execute(['nome' => $nome, 'email' => $email, 'id' => $id, 'perfil' => $perfil]);
    }
    
    public function updPass($password, $id){
        $password = hash('sha256', $password);
        $stmt = $this->conn->connect->prepare('UPDATE users SET password = :password WHERE id_user = :id');
        $stmt->execute(['password' => $password, 'id' => $id]);
            }

}