<?php
class Inscription {
    public ?int $id;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $phone;
    public string $company;
    public bool $paid;
    public int $formation_id;

    public function __construct(?int $id, string $firstName, string $lastName, string $email, string $phone, string $company, bool $paid, int $formation_id) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->company = $company;
        $this->paid = $paid;
        $this->formation_id = $formation_id;
    }
}
