<?php

require "../models/AccountModel.php";


class AccountController
{
    private $accountModel;

    public function __construct()
    {
        $this->accountModel = new AccountModel();
    }

    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Receba os dados do formulário
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $cpf = $_POST['cpf'];
            $telefone = $_POST['telefone'];
            $endereco = $_POST['endereco'];

            // Defina os dados na instância do modelo
            $this->accountModel->setNome($nome);
            $this->accountModel->setEmail($email);
            $this->accountModel->setSenha($senha);
            $this->accountModel->setCpf($cpf);
            $this->accountModel->setTelefone($telefone);
            $this->accountModel->setEndereco($endereco);

            // Realize o cadastro
            $resultadoCadastro = $this->accountModel->cadastro();

            // Verifique se o cadastro foi bem-sucedido
            if ($resultadoCadastro) {
                // Redirecione para a página de sucesso ou página inicial
                header("Location: sucesso.php");
                exit;
            } else {
                // Exiba uma mensagem de erro, se necessário
                echo "Ocorreu um erro durante o cadastro.";
            }
        }

        // Exiba o formulário de cadastro (HTML) aqui, se necessário
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Receba os dados do formulário de login
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            // Defina os dados na instância do modelo
            $this->accountModel->setEmail($email);
            $this->accountModel->setSenha($senha);

            // Realize o login
            $resultadoLogin = $this->accountModel->login();

            // Verifique se o login foi bem-sucedido
            if ($resultadoLogin) {
                // Redirecione para a página de perfil ou página inicial
                header("Location: perfil.php");
                exit;
            } else {
                // Exiba uma mensagem de erro, se necessário
                echo "Login falhou. Verifique suas credenciais.";
            }
        }

        // Exiba o formulário de login (HTML) aqui, se necessário
    }

    public function logout()
    {
        // Encerre a sessão, se aplicável
        session_destroy();

        // Redirecione para a página de login ou página inicial
        header("Location: login.php");
        exit;
    }
}

// Uso do controlador
$accountController = new AccountController();

// Determine a ação com base em parâmetros da URL ou outra lógica, e chame os métodos apropriados
if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];

    if ($acao === 'cadastrar') {
        $accountController->cadastrar();
    } elseif ($acao === 'login') {
        $accountController->login();
    } elseif ($acao === 'logout') {
        $accountController->logout();
    } else {
        // Lidar com ações desconhecidas ou inválidas aqui, se necessário
    }
}