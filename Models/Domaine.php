<?php
class Domaine {
    public ?int $id;
    public string $domaine_name;
    public ?string $description;

    public function __construct(?int $id, string $domaine_name, ?string $description = null) {
        $this->id = $id;
        $this->domaine_name = $domaine_name;
        $this->description = $description;
    }
}
