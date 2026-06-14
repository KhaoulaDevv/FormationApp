<?php
require_once __DIR__ . '/../DAOImpls/InscriptionDAOImpl.php';

class InscriptionController {
    private InscriptionDAOImpl $dao;

    public function __construct(PDO $pdo) {
        $this->dao = new InscriptionDAOImpl($pdo);
    }

    public function list() {
        $inscriptions = $this->dao->getAll();
        include __DIR__ . '/../views/admin/inscription/templates/list.php';
    }

    public function addForm() {
        include __DIR__ . '/../views/admin/inscription/templates/add.php';
    }

    public function add() {
        $data = $_POST;
        $inscription = new Inscription(null, $data['firstName'], $data['lastName'], $data['email'], $data['phone'], $data['company'], isset($data['paid']), $data['formation_id']);
        if ($this->dao->create($inscription)) {
            header('Location: list.php');
            exit;
        }
        include __DIR__ . '/../views/admin/inscription/templates/add.php';
    }

    public function editForm() {
        $id = intval($_GET['id']);
        $inscription = $this->dao->getById($id);
        include __DIR__ . '/../views/admin/inscription/templates/edit.php';
    }

    public function edit() {
        $data = $_POST;
        $inscription = new Inscription($data['id'], $data['firstName'], $data['lastName'], $data['email'], $data['phone'], $data['company'], isset($data['paid']), $data['formation_id']);
        $this->dao->update($inscription);
        header('Location: list.php');
    }

    public function delete() {
        $id = intval($_GET['id']);
        $this->dao->delete($id);
        header('Location: list.php');
    }
}
