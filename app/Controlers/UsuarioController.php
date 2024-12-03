<?php

namespace App\Controlers;

use App\Models\Usuario;
use App\Models\Conn;

use Exception;

require_once '../Models/Conn.php';
require_once '../Models/Usuario.php';

class UsuarioController
{
    private $usuario;

    public function __construct()
    {
        $conn = new Conn();
        $this->usuario = new Usuario($conn);
    }

    /**
     * Tenta realizar o login com o email e senha informados.
     * 
     * @param string $email Email do usuário.
     * @param string $senha Senha do usuário.
     * 
     * @return bool Retorna true caso o login seja bem-sucedido, false caso contrário.
     */
    public function login($email, $senha): bool
    {
        if (is_null($email) || is_null($senha)) {
            return false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return $this->usuario->login($email, $senha);
    }

    public function listar(){

        return $this->usuario->listarTodos();
    }

    public function deletar($id){
        return $this->usuario->deletar($id);
    }

    /**
     * Tenta cadastrar um novo usuário com as informações fornecidas.
     * 
     * @param string $nome Nome do usuário.
     * @param string $email E-mail do usuário.
     * @param string $senha Senha do usuário.
     * @param string $perfil Perfil do usuário (1 para usuário, 2 para administrador).
     * 
     * @return bool Retorna true caso o cadastro seja bem-sucedido, false caso contrário.
     * @throws Exception Lança uma exceção caso o nome seja inválido ou o e-mail não seja um endereço de email válido.
     */
    public function cadastrar($nome, $email, $senha, $perfil){
        if (empty($nome) || strlen($nome) < 3 || strlen($nome) > 30)
            throw new Exception("Nome inválido");
        else
            $this->$nome = $nome;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            throw new Exception("E-mail inválido");
        else
            $this->$email = $email;

        return $this->usuario->cadastrar($nome, $email, $senha, $perfil);
    }

    public function editar($id){

        return $this->usuario->editar($id);
    }

    /**
     * Tenta atualizar um usuário com as informações fornecidas.
     * 
     * @param string $nome Novo nome do usuário.
     * @param string $email Novo e-mail do usuário.
     * @param int $id ID do usuário a ser atualizado.
     * @param string $perfil Novo perfil do usuário (1 para usuário, 2 para administrador).
     * 
     * @return bool Retorna true caso a atualização seja bem-sucedida, false caso contrário.
     * @throws Exception Lança uma exceção caso o nome seja inválido ou o e-mail não seja um endereço de email válido.
     */
    public function updUser($nome, $email, $id, $perfil){
        if (empty($nome) || strlen($nome) < 3 || strlen($nome) > 30)
            throw new Exception("Nome inválido");
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            throw new Exception("E-mail inválido");
       
        try {
            return $this->usuario->updUser($nome, $id, $email, $perfil);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Atualiza a senha do usuário.
     * 
     * @param string $password Nova senha do usuário.
     * @param int $id ID do usuário.
     * 
     * @return bool Retorna true caso a atualização seja bem-sucedida, false caso contrário.
     * @throws Exception Lança uma exceção caso haja um erro durante a atualização.
     */
    public function updPass($password, $id){
        try{
        return $this->usuario->updPass($password, $id);
        }
        catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}
