<?php

interface CoursDAO {
    public function getAll(): array;
    public function getById(int $id): ?Cours;
    public function create(Cours $cours): bool;
    public function update(Cours $cours): bool;
    public function delete(int $id): bool;
}
