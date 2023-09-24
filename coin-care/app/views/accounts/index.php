<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Suas Contas Bancarias</h1>
    <ul>
        <?php foreach ($accounts as $account) : ?>
            <li>
                <?= $account['name'] ?> Saldo: R$ <? $account['initial_balance'] ?>
                <a href="/accounts/edit/<?= $account['id'] ?>">Editar</a>
                <a href="/accounts/delete/<?= $account['id'] ?>">Excluir</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="/accounts/add">Adicionar Nova Conta</a>
</body>

</html>