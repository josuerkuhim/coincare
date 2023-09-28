<!DOCTYPE html>
<html>
<head>
    <title>Formulário de Transação</title>
</head>
<body>
    <h2>Formulário de Transação</h2>
    <form action="../../controllers/TransactionController.php" method="POST">
        <label for="id_tipo_transacao">ID Tipo de Transação:</label>
        <input type="number" id="id_tipo_transacao" name="id_tipo_transacao" required><br><br>

        <label for="dt_transacao">Data da Transação:</label>
        <input type="date" id="dt_transacao" name="dt_transacao" required><br><br>

        <label for="vl_transacao">Valor da Transação:</label>
        <input type="text" id="vl_transacao" name="vl_transacao" required><br><br>

        <input type="submit" value="Inserir Transação">
    </form>
</body>
</html>
