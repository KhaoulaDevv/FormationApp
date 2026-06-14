<?php
require_once __DIR__ . '/../Models/Inscription.php';
require_once __DIR__ . '/../DAOs/InscriptionDAO.php';

class InscriptionDAOImpl implements InscriptionDAO {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM Inscription");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $inscriptions = [];
            foreach ($rows as $row) {
                $inscriptions[] = new Inscription(
                    $row['id'],
                    $row['firstName'],
                    $row['lastName'],
                    $row['email'],   // Correct order: email first
                    $row['phone'],   // then phone
                    $row['company'],
                    (bool)$row['paid'],  // cast to bool to be safe
                    (int)$row['formation_id']
                );
            }
            return $inscriptions;
    }

    public function getById(int $id): ?Inscription {
        $stmt = $this->pdo->prepare("SELECT * FROM Inscription WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new Inscription(
            $data['id'],
            $data['firstName'],
            $data['lastName'],
            $data['email'],
            $data['phone'],
            $data['company'],
            (bool)$data['paid'],
            (int)$data['formation_id']
        ) : null;
    }

    public function getByUserId(int $user_id): array {
        $stmt = $this->pdo->prepare("SELECT * FROM Inscription WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $inscriptions = [];
        foreach ($rows as $row) {
            $inscriptions[] = new Inscription(
                $row['id'],
                $row['firstName'],
                $row['lastName'],
                $row['email'],
                $row['phone'],
                $row['company'],
                (bool)$row['paid'],
                (int)$row['formation_id']
            );
        }
        return $inscriptions;
    }

    public function getFormationIdsByUserId(int $user_id): array {
        $stmt = $this->pdo->prepare("SELECT formation_id FROM Inscription WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0); // fetch just the first column as array
    }


    public function create(Inscription $inscription): bool {
        $stmt = $this->pdo->prepare("INSERT INTO Inscription (firstName, lastName, email, phone, company, paid, formation_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $inscription->firstName, $inscription->lastName, $inscription->email,
            $inscription->phone, $inscription->company, $inscription->paid, $inscription->formation_id
        ]);
    }

    public function update(Inscription $inscription): bool {
        $stmt = $this->pdo->prepare("UPDATE Inscription SET firstName=?, lastName=?, email=?, phone=?, company=?, paid=?, formation_id=? WHERE id=?");
        return $stmt->execute([
            $inscription->firstName, $inscription->lastName, $inscription->email,
            $inscription->phone, $inscription->company, $inscription->paid,
            $inscription->formation_id, $inscription->id
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM Inscription WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
