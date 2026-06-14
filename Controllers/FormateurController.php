<?php
require_once __DIR__ . '/../DAOImpls/FormateurDAOImpl.php';

class FormateurController {
    private FormateurDAOImpl $formateurDAO;

    public function __construct(PDO $pdo) {
        $this->formateurDAO = new FormateurDAOImpl($pdo);
    }

    public function list() {
        $formateurList = $this->formateurDAO->getAll();
        include __DIR__ . '/../views/admin/formateur/templates/list.php';
    }

    public function addForm() {
        include __DIR__ . '/../views/admin/formateur/templates/add.php';
    }

    public function add() {
        $firstName = trim($_POST['firstName'] ?? '');
        $lastName = trim($_POST['lastName'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $photo = trim($_POST['photo'] ?? '');

        if ($firstName === '' || $lastName === '') {
            $error = "Le prénom et le nom sont obligatoires.";
            include __DIR__ . '/../views/admin/formateur/templates/add.php';
            return;
        }

        $formateur = new Formateur(null, $firstName, $lastName, $description, $photo);

        if ($this->formateurDAO->create($formateur)) {
            header('Location: list.php');
            exit;
        } else {
            $error = "Erreur lors de l'ajout du formateur.";
            include __DIR__ . '/../views/admin/formateur/templates/add.php';
        }
    }

    public function editForm() {
        $id = intval($_GET['id'] ?? 0);
        $formateur = $this->formateurDAO->getById($id);
        if (!$formateur) {
            header('Location: list.php');
            exit;
        }
        include __DIR__ . '/../views/admin/formateur/templates/edit.php';
    }

    public function edit() {
        $id = intval($_POST['id'] ?? 0);
        $firstName = trim($_POST['firstName'] ?? '');
        $lastName = trim($_POST['lastName'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $photo = trim($_POST['photo'] ?? '');

        if ($firstName === '' || $lastName === '') {
            $error = "Le prénom et le nom sont obligatoires.";
            $formateur = new Formateur($id, $firstName, $lastName, $description, $photo);
            include __DIR__ . '/../views/admin/formateur/templates/edit.php';
            return;
        }

        $formateur = new Formateur($id, $firstName, $lastName, $description, $photo);

        if ($this->formateurDAO->update($formateur)) {
            header('Location: list.php');
            exit;
        } else {
            $error = "Erreur lors de la mise à jour du formateur.";
            include __DIR__ . '/../views/admin/formateur/templates/edit.php';
        }
    }

    public function delete() {
        $id = intval($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->formateurDAO->delete($id);
        }
        header('Location: list.php');
        exit;
    }
}
