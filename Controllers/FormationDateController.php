<?php
require_once __DIR__ . '/../DAOImpls/FormationDateDAOImpl.php';

class FormationDateController {
    private FormationDateDAOImpl $formationDateDAO;

    public function __construct(PDO $pdo) {
        $this->formationDateDAO = new FormationDateDAOImpl($pdo);
    }

    public function index(): array {
        return $this->formationDateDAO->findAll();
    }

    public function show(int $id): ?FormationDate {
        return $this->formationDateDAO->findById($id);
    }

    public function create(string $date): bool {
        $formationDate = new FormationDate(null, $date);
        return $this->formationDateDAO->save($formationDate);
    }

    public function update(int $id, string $date): bool {
        $formationDate = $this->formationDateDAO->findById($id);
        if (!$formationDate) return false;

        $formationDate->setDate($date);
        return $this->formationDateDAO->update($formationDate);
    }

    public function delete(int $id): bool {
        return $this->formationDateDAO->delete($id);
    }
}
