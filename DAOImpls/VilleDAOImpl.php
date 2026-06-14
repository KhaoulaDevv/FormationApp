<?php
require_once __DIR__ . '/../Models/Ville.php';
require_once __DIR__ . '/../DAOs/VilleDAO.php';

class VilleDAOImpl implements VilleDAO {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM Ville");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $villeList = [];
        foreach ($results as $row) {
            $villeList[] = new Ville($row['id'], $row['ville_name'], $row['pays_id'] !== null ? (int)$row['pays_id'] : null);
        }
        return $villeList;
    }

    public function getById(int $id): ?Ville {
        $stmt = $this->pdo->prepare("SELECT * FROM Ville WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Ville($row['id'], $row['ville_name'], $row['pays_id'] !== null ? (int)$row['pays_id'] : null);
        }
        return null;
    }

    public function create(Ville $ville): bool {
        $stmt = $this->pdo->prepare("INSERT INTO Ville (ville_name, pays_id) VALUES (?, ?)");
        return $stmt->execute([$ville->ville_name, $ville->pays_id]);
    }

    public function update(Ville $ville): bool {
        $stmt = $this->pdo->prepare("UPDATE Ville SET ville_name = ?, pays_id = ? WHERE id = ?");
        return $stmt->execute([$ville->ville_name, $ville->pays_id, $ville->id]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM Ville WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getByPaysId(int $pays_id): array {
        $stmt = $this->pdo->prepare("SELECT * FROM Ville WHERE pays_id = ? ORDER BY ville_name");
        $stmt->execute([$pays_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $villeList = [];
        foreach ($results as $row) {
            $villeList[] = new Ville($row['id'], $row['ville_name'], $row['pays_id'] !== null ? (int)$row['pays_id'] : null);
        }
        return $villeList;
    }

}
