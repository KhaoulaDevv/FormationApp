<?php
require_once __DIR__ . '/../Models/Sujet.php';
require_once __DIR__ . '/../DAOs/SujetDAO.php';

class SujetDAOImpl implements SujetDAO {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAll(): array {
        $stmt = $this->pdo->query("SELECT s.*, d.domaine_name FROM Sujet s LEFT JOIN Domaine d ON s.domaine_id = d.id");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => new Sujet(
            $row['id'], $row['sujet_name'], $row['shortDescription'], $row['longDescription'],
            $row['individualBenefit'], $row['businessBenefit'], $row['logo'], $row['domaine_id'],
            $row['domaine_name'] ?? null
        ), $rows);
    }

    public function getById(int $id): ?Sujet {
        $stmt = $this->pdo->prepare("SELECT s.*, d.domaine_name FROM Sujet s LEFT JOIN Domaine d ON s.domaine_id = d.id WHERE s.id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Sujet(
            $row['id'], $row['sujet_name'], $row['shortDescription'], $row['longDescription'],
            $row['individualBenefit'], $row['businessBenefit'], $row['logo'], $row['domaine_id'],
            $row['domaine_name'] ?? null
        ) : null;
    }

    public function create(Sujet $sujet): bool {
        $stmt = $this->pdo->prepare("INSERT INTO Sujet (sujet_name, shortDescription, longDescription, individualBenefit, businessBenefit, logo, domaine_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $sujet->sujet_name, $sujet->shortDescription, $sujet->longDescription,
            $sujet->individualBenefit, $sujet->businessBenefit, $sujet->logo, $sujet->domaine_id
        ]);
    }

    public function update(Sujet $sujet): bool {
        $stmt = $this->pdo->prepare("UPDATE Sujet SET sujet_name=?, shortDescription=?, longDescription=?, individualBenefit=?, businessBenefit=?, logo=?, domaine_id=? WHERE id=?");
        return $stmt->execute([
            $sujet->sujet_name, $sujet->shortDescription, $sujet->longDescription,
            $sujet->individualBenefit, $sujet->businessBenefit, $sujet->logo,
            $sujet->domaine_id, $sujet->id
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM Sujet WHERE id = ?");
        return $stmt->execute([$id]);
    }
}