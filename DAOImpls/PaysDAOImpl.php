<?php
require_once __DIR__ . '/../Models/Pays.php';
require_once __DIR__ . '/../DAOs/PaysDAO.php';

class PaysDAOImpl implements PaysDAO {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM Pays");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById(int $id): ?Pays {
        $stmt = $this->pdo->prepare("SELECT * FROM Pays WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Pays($row['id'], $row['pays_name']);
        }
        return null;
    }

    public function create(Pays $pays): bool {
        $stmt = $this->pdo->prepare("INSERT INTO Pays (pays_name) VALUES (?)");
        return $stmt->execute([$pays->pays_name]);
    }

    public function update(Pays $pays): bool {
        $stmt = $this->pdo->prepare("UPDATE Pays SET pays_name = ? WHERE id = ?");
        return $stmt->execute([$pays->pays_name, $pays->id]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM Pays WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
