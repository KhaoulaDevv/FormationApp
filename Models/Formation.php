<?php
class Formation {
    public ?int $id;
    public float $price;
    public string $mode;
    public ?int $cours_id;
    public ?int $formateur_id;
    public ?int $formation_date_id;
    public ?int $ville_id;

    public function __construct(?int $id, float $price, string $mode, ?int $cours_id, ?int $formateur_id, ?int $formation_date_id, ?int $ville_id) {
        $this->id = $id;
        $this->price = $price;
        $this->mode = $mode;
        $this->cours_id = $cours_id;
        $this->formateur_id = $formateur_id;
        $this->formation_date_id = $formation_date_id;
        $this->ville_id = $ville_id;
    }
}
