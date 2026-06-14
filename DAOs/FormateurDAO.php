<?php
interface FormateurDAO {
    public function getAll(): array;
    public function getById(int $id): ?Formateur;
    public function create(Formateur $formateur): bool;
    public function update(Formateur $formateur): bool;
    public function delete(int $id): bool;
}
