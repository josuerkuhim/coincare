<!DOCTYPE html>
<html>
<head>
    <title>Formulário de Cadastro</title>
</head>
<body>
    <h2>Cadastro de Usuário</h2>
    <form action="../../controllers/AuthController.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required><br><br>

        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone"><br><br>

        <input type="submit" value="Cadastrar">
        <span>TESTE</span>
    </form>
</body>
</html>
