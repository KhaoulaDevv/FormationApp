<?php

class FormationDate {
    private int $id;
    private string $date;

    public function __construct(int $id = 0, string $date = '') {
        $this->id = $id;
        $this->date = $date;
    }

    public function getId(): int { return $this->id; }
    public function getDate(): string { return $this->date; }

    public function setId(int $id): void { $this->id = $id; }
    public function setDate(string $date): void { $this->date = $date; }
}
