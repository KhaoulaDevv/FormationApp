<?php
interface DomaineDAO {
    public function getAll(): array;
    public function getById(int $id): ?Domaine;
    public function create(Domaine $domaine): bool;
    public function update(Domaine $domaine): bool;
    public function delete(int $id): bool;
}
