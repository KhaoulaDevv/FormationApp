<?php
require_once __DIR__ . '/../DAOImpls/CoursDAOImpl.php';
require_once __DIR__ . '/../DAOImpls/SujetDAOImpl.php';

class CoursController {
    private CoursDAOImpl $coursDAO;
    private SujetDAOImpl $sujetDAO;

    public function __construct(PDO $pdo) {
        $this->coursDAO = new CoursDAOImpl($pdo);
        $this->sujetDAO = new SujetDAOImpl($pdo);
    }

    public function list() {
        $coursList = $this->coursDAO->getAll();
        include __DIR__ . '/../views/admin/cours/templates/list.php';
    }

    public function addForm() {
        require_once __DIR__ . '/../DAOImpls/SujetDAOImpl.php';
        $sujetList = $this->sujetDAO->getAll();

        include __DIR__ . '/../views/admin/cours/templates/add.php';
    }

    public function add() {
        $cours_name = trim($_POST['cours_name'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $audience = trim($_POST['audience'] ?? '');
        $duration = intval($_POST['duration'] ?? 0);
        $testIncluded = isset($_POST['testIncluded']);
        $testContent = trim($_POST['testContent'] ?? '');
        $logo = trim($_POST['logo'] ?? '');
        $sujet_id = intval($_POST['sujet_id'] ?? 0);

        if ($cours_name === '') {
            $error = "Le nom du cours est obligatoire.";
            require_once __DIR__ . '/../DAOImpls/SujetDAOImpl.php';
            $sujetList = $this->sujetDAO->getAll();

            include __DIR__ . '/../views/admin/cours/templates/add.php';
            return;
        }

        $cours = new Cours(null, $cours_name, $content, $description, $audience, $duration, $testIncluded, $testContent, $logo, $sujet_id);

        if ($this->coursDAO->create($cours)) {
            header('Location: list.php');
            exit;
        } else {
            $error = "Erreur lors de l'ajout du cours.";
            require_once __DIR__ . '/../DAOImpls/SujetDAOImpl.php';
            $sujetList = $this->sujetDAO->getAll();
            include __DIR__ . '/../views/admin/cours/templates/add.php';
        }
    }

    public function editForm() {
        $id = intval($_GET['id'] ?? 0);
        $cours = $this->coursDAO->getById($id);
        if (!$cours) {
            header('Location: list.php');
            exit;
        }

        require_once __DIR__ . '/../DAOImpls/SujetDAOImpl.php';
        $sujetList = $this->sujetDAO->getAll();

        include __DIR__ . '/../views/admin/cours/templates/edit.php';
    }

    public function edit() {
        $id = intval($_POST['id'] ?? 0);
        $cours_name = trim($_POST['cours_name'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $audience = trim($_POST['audience'] ?? '');
        $duration = intval($_POST['duration'] ?? 0);
        $testIncluded = isset($_POST['testIncluded']);
        $testContent = trim($_POST['testContent'] ?? '');
        $logo = trim($_POST['logo'] ?? '');
        $sujet_id = intval($_POST['sujet_id'] ?? 0);

        if ($cours_name === '') {
            $error = "Le nom du cours est obligatoire.";
            $cours = new Cours($id, $cours_name, $content, $description, $audience, $duration, $testIncluded, $testContent, $logo, $sujet_id);

            require_once __DIR__ . '/../DAOImpls/SujetDAOImpl.php';
            $sujetList = $this->sujetDAO->getAll();

            include __DIR__ . '/../views/admin/cours/templates/edit.php';
            return;
        }

        $cours = new Cours($id, $cours_name, $content, $description, $audience, $duration, $testIncluded, $testContent, $logo, $sujet_id);

        if ($this->coursDAO->update($cours)) {
            header('Location: list.php');
            exit;
        } else {
            $error = "Erreur lors de la mise à jour du cours.";

            require_once __DIR__ . '/../DAOImpls/SujetDAOImpl.php';
            $sujetList = $this->sujetDAO->getAll();

            include __DIR__ . '/../views/admin/cours/templates/edit.php';
        }
    }

    public function delete() {
        $id = intval($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->coursDAO->delete($id);
        }
        header('Location: list.php');
        exit;
    }
}
