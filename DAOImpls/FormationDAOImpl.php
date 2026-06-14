<?php
require_once __DIR__ . '/../Models/Formation.php';

class FormationDAOImpl {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Get all formations without filter
    public function getAll(): array {
        $sql = "SELECT f.*,
                       c.cours_name,
                       fo.firstName AS formateur_firstName, fo.lastName AS formateur_lastName,
                       v.ville_name,
                       fd.date
                FROM Formation f
                LEFT JOIN Cours c ON f.cours_id = c.id
                LEFT JOIN Formateur fo ON f.formateur_id = fo.id
                LEFT JOIN Ville v ON f.ville_id = v.id
                LEFT JOIN FormationDate fd ON f.formation_date_id = fd.id
                ORDER BY fd.date DESC";

        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get formation by ID
    public function getById(int $id): ?Formation {
        $stmt = $this->pdo->prepare("SELECT * FROM Formation WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Formation(
                $row['id'],
                $row['price'],
                $row['mode'],
                $row['cours_id'],
                $row['formateur_id'],
                $row['formation_date_id'],
                $row['ville_id']
            );
        }
        return null;
    }

    // Create new formation
    public function create(Formation $formation): bool {
        $stmt = $this->pdo->prepare("INSERT INTO Formation (price, mode, cours_id, formateur_id, formation_date_id, ville_id) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $formation->price,
            $formation->mode,
            $formation->cours_id,
            $formation->formateur_id,
            $formation->formation_date_id,
            $formation->ville_id
        ]);
    }

    // Update existing formation
    public function update(Formation $formation): bool {
        $stmt = $this->pdo->prepare("UPDATE Formation SET price = ?, mode = ?, cours_id = ?, formateur_id = ?, formation_date_id = ?, ville_id = ? WHERE id = ?");
        return $stmt->execute([
            $formation->price,
            $formation->mode,
            $formation->cours_id,
            $formation->formateur_id,
            $formation->formation_date_id,
            $formation->ville_id,
            $formation->id
        ]);
    }

    // Delete formation by ID
    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM Formation WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getFiltered(array $filters): array {
        $sql = "SELECT f.id as formation_id,
                       f.price,
                       f.mode,
                       c.cours_name,
                       s.sujet_name,
                       d.domaine_name,
                       fo.firstName as formateur_firstName,
                       fo.lastName as formateur_lastName,
                       fd.date as formation_date,
                       v.ville_name,
                       p.id as pays_id
                FROM Formation f
                LEFT JOIN Cours c ON f.cours_id = c.id
                LEFT JOIN Sujet s ON c.sujet_id = s.id
                LEFT JOIN Domaine d ON s.domaine_id = d.id
                LEFT JOIN Formateur fo ON f.formateur_id = fo.id
                LEFT JOIN FormationDate fd ON f.formation_date_id = fd.id
                LEFT JOIN Ville v ON f.ville_id = v.id
                LEFT JOIN Pays p ON v.pays_id = p.id
                WHERE 1=1";

        $params = [];

        if (!empty($filters['pays_id']) && $filters['pays_id'] != 0) {
            $sql .= " AND p.id = ?";
            $params[] = $filters['pays_id'];
        }

        if (!empty($filters['ville_id']) && $filters['ville_id'] != 0) {
            $sql .= " AND v.id = ?";
            $params[] = $filters['ville_id'];
        }

        if (!empty($filters['search'])) {
            $sql .= " AND (d.domaine_name LIKE ? OR s.sujet_name LIKE ? OR c.cours_name LIKE ?)";
            $like = '%' . $filters['search'] . '%';
            $params[] = $like;
            $params[] = $like;
            $params[] = $like;
        }

        $sql .= " ORDER BY fd.date DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


}
