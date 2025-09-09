<?php

namespace App\Helpers;

use PDO;
use PDOException;

class PdoUser
{
    protected $pdo;

    public function __construct()
    {
        $host = env('DB_HOST', '127.0.0.1');
        $db   = env('DB_DATABASE', 'job_test');
        $user = env('DB_USERNAME', 'root');
        $pass = env('DB_PASSWORD', '');
        $charset = env('DB_CHARSET', 'utf8mb4');
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            throw new \Exception('Database connection failed: ' . $e->getMessage());
        }
    }

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function getAll($limit = 10, $offset = 0)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users ORDER BY id DESC LIMIT :limit OFFSET :offset');
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($name, $email, $password)
    {
        $stmt = $this->pdo->prepare('INSERT INTO users (name, email, password, created_at, updated_at) VALUES (:name, :email, :password, NOW(), NOW())');
        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
    }

    public function update($id, $name, $email, $password = null)
    {
        if ($password) {
            $stmt = $this->pdo->prepare('UPDATE users SET name = :name, email = :email, password = :password, updated_at = NOW() WHERE id = :id');
            return $stmt->execute([
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);
        } else {
            $stmt = $this->pdo->prepare('UPDATE users SET name = :name, email = :email, updated_at = NOW() WHERE id = :id');
            return $stmt->execute([
                'id' => $id,
                'name' => $name,
                'email' => $email,
            ]);
        }
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
