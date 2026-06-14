<?php
require_once __DIR__ . '/../DAOImpls/VilleDAOImpl.php';
require_once __DIR__ . '/../DAOImpls/PaysDAOImpl.php'; // To fetch Pays list

class VilleController {
    private VilleDAOImpl $villeDAO;
    private PaysDAOImpl $paysDAO;

    public function __construct(PDO $pdo) {
        $this->villeDAO = new VilleDAOImpl($pdo);
        $this->paysDAO = new PaysDAOImpl($pdo);
    }

    public function list() {
        $villeList = $this->villeDAO->getAll();
        $paysList = $this->paysDAO->getAll(); // to map pays_id => pays_name
        include __DIR__ . '/../views/admin/ville/templates/list.php';
    }

    public function addForm($error = null, $old = null) {
        $paysList = $this->paysDAO->getAll();
        include __DIR__ . '/../views/admin/ville/templates/add.php';
    }

    public function add() {
        $ville_name = trim($_POST['ville_name'] ?? '');
        $pays_id = isset($_POST['pays_id']) && $_POST['pays_id'] !== '' ? intval($_POST['pays_id']) : null;

        if ($ville_name === '') {
            $error = "Le nom de la ville est obligatoire.";
            $old = ['ville_name' => $ville_name, 'pays_id' => $pays_id];
            $this->addForm($error, $old);
            return;
        }

        $ville = new Ville(null, $ville_name, $pays_id);
        if ($this->villeDAO->create($ville)) {
            header('Location: list.php');
            exit;
        } else {
            $error = "Erreur lors de l'ajout.";
            $old = ['ville_name' => $ville_name, 'pays_id' => $pays_id];
            $this->addForm($error, $old);
        }
    }

    public function editForm($error = null) {
        $id = intval($_GET['id'] ?? 0);
        $ville = $this->villeDAO->getById($id);
        if (!$ville) {
            header('Location: list.php');
            exit;
        }
        $paysList = $this->paysDAO->getAll();
        include __DIR__ . '/../views/admin/ville/templates/edit.php';
    }

    public function edit() {
        $id = intval($_POST['id'] ?? 0);
        $ville_name = trim($_POST['ville_name'] ?? '');
        $pays_id = isset($_POST['pays_id']) && $_POST['pays_id'] !== '' ? intval($_POST['pays_id']) : null;

        if ($ville_name === '') {
            $error = "Le nom de la ville est obligatoire.";
            $ville = new Ville($id, $ville_name, $pays_id);
            $paysList = $this->paysDAO->getAll();
            include __DIR__ . '/../views/admin/ville/templates/edit.php';
            return;
        }

        $ville = new Ville($id, $ville_name, $pays_id);
        if ($this->villeDAO->update($ville)) {
            header('Location: list.php');
            exit;
        } else {
            $error = "Erreur lors de la mise à jour.";
            $paysList = $this->paysDAO->getAll();
            include __DIR__ . '/../views/admin/ville/templates/edit.php';
        }
    }

    public function delete() {
        $id = intval($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->villeDAO->delete($id);
        }
        header('Location: list.php');
        exit;
    }
}
