<?php
public function __construct()
    {
        try {
            $this->db = new PDO('pgsql:host=localhost;dbname=coincare;user=postgres;password=123');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro na conexão com o banco de dados: " . $e->getMessage();
        }
    }