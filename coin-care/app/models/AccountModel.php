<?php

class AccountModel
{
    private $nome;
    private $email;
    private $senha;
    private $cpf;
    private $telefone;
    private $endereco;
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

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
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

    public function cadastro()
    {
        try {
            $sql = "INSERT INTO usuario (nome, email, senha, cpf, telefone, endereco) VALUES (:nome, :email, :senha, :cpf, :telefone, :endereco)";
            $query = $this->database->getDatabase()->prepare($sql);
            $query->bindParam(':nome', $this->nome, PDO::PARAM_STR);
            $query->bindParam(':email', $this->email, PDO::PARAM_STR);
            $query->bindParam(':senha', $this->senha, PDO::PARAM_STR);
            $query->bindParam(':cpf', $this->cpf, PDO::PARAM_STR);
            $query->bindParam(':telefone', $this->telefone, PDO::PARAM_STR);
            $query->bindParam(':endereco', $this->endereco, PDO::PARAM_STR);

            if ($query->execute()) {
                echo "Registro inserido com sucesso!";
            } else {
                echo "Erro na execução da consulta: " . $query->errorInfo()[2];
            }
        } catch (PDOException $e) {
            echo "Erro na preparação da consulta: " . $e->getMessage();
        }
    }

    public function login()
    {
        try {
            $sql = "SELECT * FROM usuario WHERE email = :email AND senha = :senha";
            $query = $this->database->getDatabase()->prepare($sql);
            $query->bindParam(':email', $this->email, PDO::PARAM_STR);
            $query->bindParam(':senha', $this->senha, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                if ($result) {
                    $this->setId($result[0]['id']);
                    $this->setNome($result[0]['nome']);
                    $this->setEmail($result[0]['email']);
                    $this->setSenha($result[0]['senha']);
                    $this->setCpf($result[0]['cpf']);
                    $this->setTelefone($result[0]['telefone']);
                    $this->setEndereco($result[0]['endereco']);
                    return true;
                } else {
                    echo "Error";
                }
            } else {
                echo "Erro na execução da consulta: ". $query->errorInfo()[2];
            }
        } catch (Exception $e) {
            echo "Erro na preparação da consulta: " . $e->getMessage();
        }
    }
}
