<?php
require_once __DIR__ . '/../Models/Cours.php';
require_once __DIR__ . '/../DAOs/CoursDAO.php';

class CoursDAOImpl implements CoursDAO {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAll(): array {
        $stmt = $this->pdo->query(
            "SELECT c.*, s.sujet_name
             FROM Cours c
             LEFT JOIN Sujet s ON c.sujet_id = s.id"
        );
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById(int $id): ?Cours {
        $stmt = $this->pdo->prepare("SELECT * FROM Cours WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Cours(
                $row['id'],
                $row['cours_name'],
                $row['content'],
                $row['description'],
                $row['audience'],
                $row['duration'],
                (bool)$row['testIncluded'],
                $row['testContent'],
                $row['logo'],
                $row['sujet_id']
            );
        }
        return null;
    }

    public function create(Cours $cours): bool {
        $stmt = $this->pdo->prepare(
            "INSERT INTO Cours (cours_name, content, description, audience, duration, testIncluded, testContent, logo, sujet_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $cours->cours_name,
            $cours->content,
            $cours->description,
            $cours->audience,
            $cours->duration,
            $cours->testIncluded,
            $cours->testContent,
            $cours->logo,
            $cours->sujet_id
        ]);
    }

    public function update(Cours $cours): bool {
        $stmt = $this->pdo->prepare(
            "UPDATE Cours SET
                cours_name = ?,
                content = ?,
                description = ?,
                audience = ?,
                duration = ?,
                testIncluded = ?,
                testContent = ?,
                logo = ?,
                sujet_id = ?
            WHERE id = ?"
        );
        return $stmt->execute([
            $cours->cours_name,
            $cours->content,
            $cours->description,
            $cours->audience,
            $cours->duration,
            $cours->testIncluded,
            $cours->testContent,
            $cours->logo,
            $cours->sujet_id,
            $cours->id
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM Cours WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
