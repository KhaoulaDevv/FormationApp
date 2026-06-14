<?php

interface UsersDAO {
    public function findById(int $id): ?Users;
    public function findByUsername(string $username): ?Users;
    public function findAll(): array;
    public function save(Users $user): bool;
    public function update(Users $user): bool;
    public function delete(int $id): bool;
}
