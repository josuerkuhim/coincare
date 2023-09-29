<?php
require_once "../models/UserModel.php";
// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cria uma instância da classe UserModel
    $userModel = new UserModel();

    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];

    // Verifica se o usuário já existe
    $user = $userModel->getUserByEmail($email);

    // Verifica se o usuário já existe
    if (!$user) {
        // Cria o usuário
        $userModel->cadastro($nome, $email, $senha, $cpf, $telefone);
        // Redireciona para a página de login
        header('Location: login.php');
    } else {
        // Redireciona para a página de login
        header('Location login.php');
    }
}
