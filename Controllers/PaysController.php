<?php
require_once __DIR__ . '/../DAOImpls/PaysDAOImpl.php';

class PaysController {
    private PaysDAOImpl $paysDAO;

    public function __construct(PDO $pdo) {
        $this->paysDAO = new PaysDAOImpl($pdo);
    }

    public function list() {
        $paysList = $this->paysDAO->getAll();
        include __DIR__ . '/../views/admin/pays/templates/list.php';
    }

    public function addForm($error = null, $old = null) {
        include __DIR__ . '/../views/admin/pays/templates/add.php';
    }

    public function add() {
        $pays_name = trim($_POST['pays_name'] ?? '');
        if ($pays_name === '') {
            $error = "Le nom du pays est obligatoire.";
            $this->addForm($error, ['pays_name' => $pays_name]);
            return;
        }
        $pays = new Pays(null, $pays_name);
        if ($this->paysDAO->create($pays)) {
            header('Location: list.php');
            exit;
        } else {
            $error = "Erreur lors de l'ajout.";
            $this->addForm($error, ['pays_name' => $pays_name]);
        }
    }

    public function editForm($error = null) {
        $id = intval($_GET['id'] ?? 0);
        $pays = $this->paysDAO->getById($id);
        if (!$pays) {
            header('Location: list.php');
            exit;
        }
        include __DIR__ . '/../views/admin/pays/templates/edit.php';
    }

    public function edit() {
        $id = intval($_POST['id'] ?? 0);
        $pays_name = trim($_POST['pays_name'] ?? '');
        if ($pays_name === '') {
            $error = "Le nom du pays est obligatoire.";
            $pays = new Pays($id, '');
            include __DIR__ . '/../views/admin/pays/templates/edit.php';
            return;
        }
        $pays = new Pays($id, $pays_name);
        if ($this->paysDAO->update($pays)) {
            header('Location: list.php');
            exit;
        } else {
            $error = "Erreur lors de la mise à jour.";
            include __DIR__ . '/../views/admin/pays/templates/edit.php';
        }
    }

    public function delete() {
        $id = intval($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->paysDAO->delete($id);
        }
        header('Location: list.php');
        exit;
    }
}
