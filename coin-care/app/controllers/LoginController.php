<?php
require_once "../models/UserModel.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Cria uma instância da classe UserModel
    $userModel = new UserModel();

    // Verifica se o email e a senha são válidos
    $user = $userModel->getUserByEmail($email);

    if ($user && password_verify($senha, $user['senha'])) {
        // Login bem-sucedido, redireciona para a página de perfil ou qualquer outra página desejada
        header('Location: ../../index.php');
        exit;
    } else {
        // Exibe uma mensagem de erro
        echo "Usuário ou senha inválidos!";
    }
}
?>
