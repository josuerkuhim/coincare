<?php

require_once "../../config/database.php";

class TransactionModel
{
    private $id_transacao;
    private $id_tipo_transacao;
    private $vl_transacao;
    private $dt_transacao;
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getId_transacao()
    {
        return $this->id_transacao;
    }

    public function setId_transacao($id_transacao)
    {
        $this->id_transacao = $id_transacao;

        return $this;
    }

    public function getid_tipo_transacao()
    {
        return $this->id_tipo_transacao;
    }

    public function setid_tipo_transacao($id_tipo_transacao)
    {
        $this->id_tipo_transacao = $id_tipo_transacao;

        return $this;
    }

    public function getvl_transacao()
    {
        return $this->vl_transacao;
    }

    public function setvl_transacao($vl_transacao)
    {
        $this->vl_transacao = $vl_transacao;

        return $this;
    }

    public function getdt_transacao()
    {
        return $this->dt_transacao;
    }

    public function setdt_transacao($dt_transacao)
    {
        $this->dt_transacao = $dt_transacao;

        return $this;
    }

    //TODO IMPLEMENTAR FUNCIONALIDADE DE BLOQUEIO PARA AS CONTAS

    public function transacao($id_tipo_transacao, $dt_transacao, $vl_transacao)
    {
        try {
            $sql = "INSERT INTO transacao (id_tipo_transacao, dt_transacao, vl_transacao) VALUES (:id_tipo_transacao, :dt_transacao, :vl_transacao)";

            // Prepara a consulta
            $stmt = $this->database->getDatabase()->prepare($sql);

            // Vincula os parâmetros com os valores fornecidos
            $stmt->bindParam(':id_tipo_transacao', $id_tipo_transacao);
            $stmt->bindParam(':dt_transacao', $dt_transacao);
            $stmt->bindParam(':vl_transacao', $vl_transacao);

            // Executa a consulta
            $stmt->execute();

            echo "Registro inserido com sucesso!";
        } catch (PDOException $e) {
            echo "Erro na inserção do registro: " . $e->getMessage();
        }
    }
}
