<?php
require_once __DIR__ . '/../DAOImpls/SujetDAOImpl.php';
require_once __DIR__ . '/../DAOImpls/DomaineDAOImpl.php';

class SujetController {
    private SujetDAOImpl $sujetDAO;
    private DomaineDAOImpl $domaineDAO;

    public function __construct(PDO $pdo) {
        $this->sujetDAO = new SujetDAOImpl($pdo);
        $this->domaineDAO = new DomaineDAOImpl($pdo);
    }

    public function list() {
        $sujetList = $this->sujetDAO->getAll();
        include __DIR__ . '/../views/admin/sujet/templates/list.php';
    }

    public function addForm() {
        $domaineList = $this->domaineDAO->getAll();
        include __DIR__ . '/../views/admin/sujet/templates/add.php';
    }

    public function add() {
        $s = $_POST;
        $sujet = new Sujet(null, $s['sujet_name'], $s['shortDescription'], $s['longDescription'], $s['individualBenefit'], $s['businessBenefit'], $s['logo'], intval($s['domaine_id']));
        $this->sujetDAO->create($sujet);
        header('Location: list.php');
    }

    public function editForm() {
        $id = intval($_GET['id']);
        $sujet = $this->sujetDAO->getById($id);
        $domaineList = $this->domaineDAO->getAll();
        include __DIR__ . '/../views/admin/sujet/templates/edit.php';
    }

    public function edit() {
        $s = $_POST;
        $sujet = new Sujet(intval($s['id']), $s['sujet_name'], $s['shortDescription'], $s['longDescription'], $s['individualBenefit'], $s['businessBenefit'], $s['logo'], intval($s['domaine_id']));
        $this->sujetDAO->update($sujet);
        header('Location: list.php');
    }

    public function delete() {
        $this->sujetDAO->delete(intval($_GET['id']));
        header('Location: list.php');
    }
}