<?php
require_once __DIR__ . '/../Models/Users.php';
require_once __DIR__ . '/../DAOs/UsersDAO.php';

class UsersDAOImpl implements UsersDAO {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findById(int $id): ?Users {
        $stmt = $this->pdo->prepare("SELECT * FROM Users WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;

        return new Users(
            $row['id'],
            $row['lastName'],
            $row['firstName'],
            $row['email'],
            $row['password'],
            $row['role']
        );
    }

    public function findAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM Users ORDER BY lastName, firstName");
        $users = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new Users(
                $row['id'],
                $row['lastName'],
                $row['firstName'],
                $row['email'],
                $row['password'],
                $row['role']
            );
        }
        return $users;
    }

    public function save(Users $user): bool {
        $stmt = $this->pdo->prepare("INSERT INTO Users (lastName, firstName, email, password, role) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $user->getLastName(),
            $user->getFirstName(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getRole()
        ]);
    }

    public function update(Users $user): bool {
        $stmt = $this->pdo->prepare("UPDATE Users SET lastName = ?, firstName = ?, email = ?, password = ?, role = ? WHERE id = ?");
        return $stmt->execute([
            $user->getLastName(),
            $user->getFirstName(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getRole(),
            $user->getId()
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM Users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
