<?php
require_once __DIR__ . '/../DAOImpls/FormationDAOImpl.php';

class FormationController {
    private FormationDAOImpl $formationDAO;
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->formationDAO = new FormationDAOImpl($pdo);
    }

    public function list() {
        $formationList = $this->formationDAO->getAll();
        include __DIR__ . '/../views/admin/formation/templates/list.php';
    }

    public function addForm() {
        // Fetch related entities for dropdowns
        $coursList = $this->fetchAll('Cours');
        $formateurList = $this->fetchAll('Formateur');
        $villeList = $this->fetchAll('Ville');
        include __DIR__ . '/../views/admin/formation/templates/add.php';
    }

    public function add() {
        $price = floatval($_POST['price']);
        $mode = $_POST['mode'];
        $cours_id = intval($_POST['cours_id']);
        $formateur_id = intval($_POST['formateur_id']);
        $ville_id = intval($_POST['ville_id']);
        $formation_date_str = $_POST['formation_date'] ?? '';

        // Handle FormationDate insertion or retrieval
        $formation_date_id = $this->getOrCreateFormationDate($formation_date_str);

        $formation = new Formation(null, $price, $mode, $cours_id, $formateur_id, $formation_date_id, $ville_id);
        if ($this->formationDAO->create($formation)) {
            header('Location: list.php');
            exit;
        } else {
            $error = "Erreur lors de l'ajout";
            $coursList = $this->fetchAll('Cours');
            $formateurList = $this->fetchAll('Formateur');
            $villeList = $this->fetchAll('Ville');
            include __DIR__ . '/../views/admin/formation/templates/add.php';
        }
    }

    public function editForm() {
        $id = intval($_GET['id']);
        $formation = $this->formationDAO->getById($id);
        if (!$formation) {
            header('Location: list.php');
            exit;
        }

        $coursList = $this->fetchAll('Cours');
        $formateurList = $this->fetchAll('Formateur');
        $villeList = $this->fetchAll('Ville');

        // Get formation_date string if available
        $formation_date_str = '';
        if ($formation->formation_date_id) {
            $stmt = $this->pdo->prepare("SELECT date FROM FormationDate WHERE id = ?");
            $stmt->execute([$formation->formation_date_id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $formation_date_str = $row['date'];
            }
        }

        include __DIR__ . '/../views/admin/formation/templates/edit.php';
    }

    public function edit() {
        $id = intval($_POST['id']);
        $price = floatval($_POST['price']);
        $mode = $_POST['mode'];
        $cours_id = intval($_POST['cours_id']);
        $formateur_id = intval($_POST['formateur_id']);
        $ville_id = intval($_POST['ville_id']);
        $formation_date_str = $_POST['formation_date'] ?? '';

        $formation_date_id = $this->getOrCreateFormationDate($formation_date_str);

        $formation = new Formation($id, $price, $mode, $cours_id, $formateur_id, $formation_date_id, $ville_id);
        if ($this->formationDAO->update($formation)) {
            header('Location: list.php');
            exit;
        } else {
            $error = "Erreur lors de la mise à jour";
            $coursList = $this->fetchAll('Cours');
            $formateurList = $this->fetchAll('Formateur');
            $villeList = $this->fetchAll('Ville');
            include __DIR__ . '/../views/admin/formation/templates/edit.php';
        }
    }

    public function delete() {
        $id = intval($_GET['id']);
        $this->formationDAO->delete($id);
        header('Location: list.php');
        exit;
    }

    private function fetchAll(string $table): array {
        $stmt = $this->pdo->query("SELECT * FROM $table ORDER BY id");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    private function getOrCreateFormationDate(string $date_str): ?int {
        if (!$date_str) return null;

        $stmt = $this->pdo->prepare("SELECT id FROM FormationDate WHERE date = ?");
        $stmt->execute([$date_str]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return (int)$row['id'];
        } else {
            $stmtInsert = $this->pdo->prepare("INSERT INTO FormationDate (date) VALUES (?)");
            $stmtInsert->execute([$date_str]);
            return (int)$this->pdo->lastInsertId();
        }
    }
}
