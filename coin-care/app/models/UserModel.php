<?php

require_once "../../config/database.php";
class UserModel
{
    private $nome;
    private $email;
    private $senha;
    private $cpf;
    private $telefone;
    private $id;
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
        return $this;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getUserByEmail($email) {
        try {
            $sql = "SELECT * FROM usuario WHERE email = :email";
            $query = $this->database->getDatabase()->prepare($sql);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            
            if ($query->execute()) {
                $result = $query->fetch(PDO::FETCH_ASSOC);
                if ($result) {
                    // Retorna os dados do usuário como um array associativo
                    return $result;
                } else {
                    // Retorna null se o usuário não for encontrado
                    return null;
                }
            } else {
                // Tratar o erro de execução da consulta adequadamente
                return null;
            }
        } catch (PDOException $e) {
            // Tratar o erro de preparação da consulta adequadamente
            return null;
        }
    }

    //TODO IMPLEMENTAR FUNCIONALIDADE DE BLOQUEIO PARA AS CONTAS

    public function cadastro($nome, $email, $senha, $cpf, $telefone)
    {
        try {
            $hashedSenha = password_hash($senha, PASSWORD_DEFAULT); // Hash da senha

            $sql = "INSERT INTO usuario (nome, email, senha, cpf, telefone) VALUES (:nome, :email, :senha, :cpf, :telefone)";
            $query = $this->database->getDatabase()->prepare($sql);
            $query->bindParam(':nome', $nome);
            $query->bindParam(':email', $email);
            $query->bindParam(':senha', $hashedSenha);
            $query->bindParam(':cpf', $cpf);
            $query->bindParam(':telefone', $telefone);

            if ($query->execute()) {
                echo "Registro inserido com sucesso!";
            } else {
                echo "Erro na execução da consulta: " . $query->errorInfo()[2];
            }
        } catch (PDOException $e) {
            echo "Erro na preparação da consulta: " . $e->getMessage();
        }
    }

    //TODO IMPLEMENTAR FUNCIONALIDADE DE BLOQUEIO PARA AS CONTAS

    public function login()
    {
        try {
            $sql = "SELECT * FROM usuario WHERE email = :email";
            $query = $this->database->getDatabase()->prepare($sql);
            $query->bindParam(':email', $this->email, PDO::PARAM_STR);
    
            if ($query->execute()) {
                $result = $query->fetch(PDO::FETCH_ASSOC);
                if ($result && password_verify($this->senha, $result['senha'])) {
                    $this->setId($result['id']);
                    $this->setNome($result['nome']);
                    $this->setEmail($result['email']);
                    $this->setSenha($result['senha']);
                    $this->setCpf($result['cpf']);
                    $this->setTelefone($result['telefone']);
                    
                    return $result['id']; // Retorna o id_usuario quando a autenticação é bem-sucedida
                } else {
                    return false; // Senha incorreta ou usuário não encontrado
                }
            } else {
                // Tratar o erro de execução da consulta adequadamente
                return false;
            }
        } catch (Exception $e) {
            // Tratar o erro de preparação da consulta adequadamente
            return false;
        }
    }
}
