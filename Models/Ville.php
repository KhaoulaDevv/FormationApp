<?php
class Ville {
    public ?int $id;
    public string $ville_name;
    public ?int $pays_id;

    public function __construct(?int $id, string $ville_name, ?int $pays_id) {
        $this->id = $id;
        $this->ville_name = $ville_name;
        $this->pays_id = $pays_id;
    }
}
