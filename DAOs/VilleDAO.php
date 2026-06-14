<?php
interface VilleDAO {
    public function getAll(): array;
    public function getById(int $id): ?Ville;
    public function create(Ville $ville): bool;
    public function update(Ville $ville): bool;
    public function delete(int $id): bool;
    public function getByPaysId(int $pays_id): array;
}
