<?php

class AccountModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllAccounts($userId)
    {
        $query = "SELECT * FROM accounts WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addAccount($userId, $name, $initialBalance)
    {
        $query = "INSERT INTO accounts (userId, name, initialBalance) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$userId, $name, $initialBalance]);
    }

    public function getAccountById($accountId)
    {
        $query = "SELECT * FROM accounts WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$accountId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateAccount($accountId, $name, $initialBalance)
    {
        $query = "UPDATE accounts SET name = ?, initial_balance = ? WHERE i = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$name, $initialBalance, $accountId]);
    }

    public function deleteAccount($accountId)
    {
        $query = "DELETE FROM accounts WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$accountId]);
    }
}
