<?php
require_once __DIR__ . '/../Models/Domaine.php';
require_once __DIR__ . '/../DAOs/DomaineDAO.php';

class DomaineDAOImpl implements DomaineDAO {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM Domaine");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $domaines = array_map(fn($row) => new Domaine($row['id'], $row['domaine_name'], $row['description'] ?? null), $rows);
        return $domaines;
    }

    public function getById(int $id): ?Domaine {
        $stmt = $this->pdo->prepare("SELECT * FROM Domaine WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();
        return $data ? new Domaine($data['id'], $data['domaine_name'], $data['description']) : null;
    }

    public function create(Domaine $domaine): bool {
        $stmt = $this->pdo->prepare("INSERT INTO Domaine (domaine_name, description) VALUES (?, ?)");
        return $stmt->execute([$domaine->domaine_name, $domaine->description]);
    }

    public function update(Domaine $domaine): bool {
        $stmt = $this->pdo->prepare("UPDATE Domaine SET domaine_name = ?, description = ? WHERE id = ?");
        return $stmt->execute([$domaine->domaine_name, $domaine->description, $domaine->id]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM Domaine WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
