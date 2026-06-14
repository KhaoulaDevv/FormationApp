<?php
require_once __DIR__ . '/../Models/FormationDate.php';
require_once __DIR__ . '/../DAOs/FormationDateDAO.php';

class FormationDateDAOImpl implements FormationDateDAO {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findById(int $id): ?FormationDate {
        $stmt = $this->pdo->prepare("SELECT * FROM FormationDate WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;

        return new FormationDate($row['id'], $row['date']);
    }

    public function findAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM FormationDate ORDER BY date");
        $dates = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dates[] = new FormationDate($row['id'], $row['date']);
        }
        return $dates;
    }

    public function save(FormationDate $date): bool {
        $stmt = $this->pdo->prepare("INSERT INTO FormationDate (date) VALUES (?)");
        return $stmt->execute([$date->getDate()]);
    }

    public function update(FormationDate $date): bool {
        $stmt = $this->pdo->prepare("UPDATE FormationDate SET date = ? WHERE id = ?");
        return $stmt->execute([$date->getDate(), $date->getId()]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM FormationDate WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
