<?php
require_once __DIR__ . '/../Models/Formateur.php';
require_once __DIR__ . '/../DAOs/FormateurDAO.php';

class FormateurDAOImpl implements FormateurDAO {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM Formateur");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $list = [];
        foreach ($rows as $row) {
            $list[] = new Formateur(
                $row['id'],
                $row['firstName'],
                $row['lastName'],
                $row['description'],
                $row['photo']
            );
        }
        return $list;
    }

    public function getById(int $id): ?Formateur {
        $stmt = $this->pdo->prepare("SELECT * FROM Formateur WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Formateur(
                $row['id'],
                $row['firstName'],
                $row['lastName'],
                $row['description'],
                $row['photo']
            );
        }
        return null;
    }

    public function create(Formateur $formateur): bool {
        $stmt = $this->pdo->prepare("INSERT INTO Formateur (firstName, lastName, description, photo) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $formateur->firstName,
            $formateur->lastName,
            $formateur->description,
            $formateur->photo
        ]);
    }

    public function update(Formateur $formateur): bool {
        $stmt = $this->pdo->prepare("UPDATE Formateur SET firstName = ?, lastName = ?, description = ?, photo = ? WHERE id = ?");
        return $stmt->execute([
            $formateur->firstName,
            $formateur->lastName,
            $formateur->description,
            $formateur->photo,
            $formateur->id
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM Formateur WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
