<?php
class Pays {
    public ?int $id;
    public string $pays_name;

    public function __construct(?int $id, string $pays_name) {
        $this->id = $id;
        $this->pays_name = $pays_name;
    }
}
