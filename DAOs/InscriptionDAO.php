<?php
interface InscriptionDAO {
    public function getAll(): array;
    public function getById(int $id): ?Inscription;
    public function create(Inscription $inscription): bool;
    public function update(Inscription $inscription): bool;
    public function delete(int $id): bool;
    public function getByUserId(int $user_id): array;
    public function getFormationIdsByUserId(int $user_id): array;
}
