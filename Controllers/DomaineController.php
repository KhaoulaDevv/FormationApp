<?php
require_once __DIR__ . '/../DAOImpls/DomaineDAOImpl.php';

class DomaineController {
    private DomaineDAO $dao;

    public function __construct(PDO $pdo) {
        $this->dao = new DomaineDAOImpl($pdo);
    }

    public function list() {
        $domaineList = $this->dao->getAll();
        include __DIR__ . '/../views/admin/domaine/templates/list.php';
    }

    public function addForm() {
        include __DIR__ . '/../views/admin/domaine/templates/add.php';
    }

    public function add() {
        $name = trim($_POST['domaine_name'] ?? '');
        $desc = trim($_POST['description'] ?? '');
        if ($name === '') {
            $error = "Nom obligatoire.";
            include __DIR__ . '/../views/admin/domaine/templates/add.php';
            return;
        }
        $domaine = new Domaine(null, $name, $desc);
        if ($this->dao->create($domaine)) {
            header('Location: list.php');
            exit;
        }
        $error = "Erreur lors de l'ajout.";
        include __DIR__ . '/../views/admin/domaine/templates/add.php';
    }

    public function editForm() {
        $id = intval($_GET['id'] ?? 0);
        $domaine = $this->dao->getById($id);
        if (!$domaine) {
            header('Location: list.php');
            exit;
        }
        include __DIR__ . '/../views/admin/domaine/templates/edit.php';
    }

    public function edit() {
        $id = intval($_POST['id'] ?? 0);
        $name = trim($_POST['domaine_name'] ?? '');
        $desc = trim($_POST['description'] ?? '');
        if ($name === '') {
            $error = "Nom obligatoire.";
            $domaine = new Domaine($id, $name, $desc);
            include __DIR__ . '/../views/admin/domaine/templates/edit.php';
            return;
        }
        $domaine = new Domaine($id, $name, $desc);
        if ($this->dao->update($domaine)) {
            header('Location: list.php');
            exit;
        }
        $error = "Erreur lors de la mise à jour.";
        include __DIR__ . '/../views/admin/domaine/templates/edit.php';
    }

    public function delete() {
        $id = intval($_GET['id'] ?? 0);
        $this->dao->delete($id);
        header('Location: list.php');
        exit;
    }
}
