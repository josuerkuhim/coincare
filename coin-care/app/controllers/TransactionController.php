<?php
require_once "../models/TransactionModel.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction = new TransactionModel();
    // Dados da requisição POST
    $id_tipo_transacao = $_POST['id_tipo_transacao'];
    $dt_transacao = $_POST['dt_transacao'];
    $vl_transacao = $_POST['vl_transacao'];

    $transaction->transacao($id_tipo_transacao, $dt_transacao, $vl_transacao);
}

