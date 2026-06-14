<?php
interface PaysDAO {
    public function getAll(): array;
    public function getById(int $id): ?Pays;
    public function create(Pays $pays): bool;
    public function update(Pays $pays): bool;
    public function delete(int $id): bool;
}
