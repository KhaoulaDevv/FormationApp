<?php
require_once __DIR__ . '/../DAOImpls/FormationDAOImpl.php';
require_once __DIR__ . '/../DAOImpls/PaysDAOImpl.php';
require_once __DIR__ . '/../DAOImpls/VilleDAOImpl.php';
require_once __DIR__ . '/../DAOImpls/InscriptionDAOImpl.php';

class FormationClientController {
    private FormationDAOImpl $formationDAO;
    private PaysDAOImpl $paysDAO;
    private VilleDAOImpl $villeDAO;
    private InscriptionDAOImpl $InscriptionDAO;

    public function __construct(PDO $pdo) {
        $this->formationDAO = new FormationDAOImpl($pdo);
        $this->paysDAO = new PaysDAOImpl($pdo);
        $this->villeDAO = new VilleDAOImpl($pdo);
        $this->InscriptionDAO = new InscriptionDAOImpl($pdo);
    }

    public function list(array $filters, array $registered_formations = []): void {
        // Load all pays
        $paysList = $this->paysDAO->getAll();

        // Load villes filtered by pays_id if set
        $villeList = [];
        if (!empty($filters['pays_id']) && $filters['pays_id'] != 0) {
            $villeList = $this->villeDAO->getByPaysId($filters['pays_id']);
        }

        // Get filtered formations list
        $formations = $this->formationDAO->getFiltered($filters);

        // Fetch registered formations for this user
        $registeredFormationIds = [];
        if (!empty($_SESSION['user_id'])) {

                $user_id = $_SESSION['user_id'];

                $inscriptions = $this->InscriptionDAO->getByUserId($user_id);
                $registeredFormationIds = array_column($inscriptions, 'formation_id');
        }

        // Pass data to the client view
        include __DIR__ . '/../views/client/formations/templates/list.php';
    }
}
