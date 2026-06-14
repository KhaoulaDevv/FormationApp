<?php
interface SujetDAO {
    public function getAll(): array;
    public function getById(int $id): ?Sujet;
    public function create(Sujet $sujet): bool;
    public function update(Sujet $sujet): bool;
    public function delete(int $id): bool;
}
