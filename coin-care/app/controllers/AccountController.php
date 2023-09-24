<?php

class AccountController
{
    private function renderView($view, $data = [])
    {
        // Caminho para o diretório de visualizações
        $viewPath = __DIR__ . '/../views/';

        // Verifique se o arquivo de visualização existe
        if (file_exists($viewPath . $view)) {
            // Variáveis disponíveis na visualização
            extract($data);

            // Inclua o arquivo de visualização
            include($viewPath . $view);
        } else {
            // Trate o caso em que o arquivo de visualização não existe
            die("Erro: A visualização '$view' não foi encontrada.");
        }
    }

    private $accountModel;
    private $auth;

    public function __construct($accountModel, $auth)
    {
        $this->accountModel = $accountModel;
        $this->auth = $auth;
    }

    public function index($request, $response)
    {
        $userId = $this->auth->getUserId();
        $accounts = $this->accountModel->getAllAccounts($userId);

        return $this->renderView('accounts/indec.php',  ['accounts' => $accounts]);
    }

    public function create($request, $response)
    {
        $data = $request->getParsedBody();
        $name = $data['name'];
        $initialBalance = $data['initial_balance'];
        $userId = $this->auth->getUserId();
        $this->accountModel->addAccount($userId, $name, $initialBalance);
        return $response->withRedirect('/accounts');
    }

    public function edit($request, $response, $args)
    {
        $accountId = $args['id'];
        $account = $this->accountModel->getAccountById($accountId);

        if ($account['user_id'] == $this->auth->getUserId()) {
            return $this->renderView('accounts/edit.php', ['account' => $account]);
        } else {
            echo "erro";
        }
    }

    public function update($request, $response)
    {
        $data = $request->getParsedBody();
        $accountId = $data['id'];
        $name = $data['name'];
        $initialBalance = $data['initial_balance'];

        if ($this->accountModel->belengsToUser($accountId, $this->auth->getUserId())) {
            $this->accountModel->updateAccount($accountId, $name, $initialBalance);

            return $response->withRedirect('/accounts');
        } else {
            echo "erro";
        }
    }

    public function delete($request, $response, $args)
    {
        $accountId = $args['id'];

        if ($this->accountModel->belongsToUser($accountId, $this->auth->getUserId())) {
            $this->accountModel->deleteAccount($accountId);

            return $response->withRedirect('/accounts');
        } else {
            echo "erro";
        }
    }
}
