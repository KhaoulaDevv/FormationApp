<?php
class Formateur {
    public ?int $id;
    public string $firstName;
    public string $lastName;
    public ?string $description;
    public ?string $photo;

    public function __construct(?int $id, string $firstName, string $lastName, ?string $description = null, ?string $photo = null) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->description = $description;
        $this->photo = $photo;
    }
}
