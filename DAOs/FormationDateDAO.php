<?php

interface FormationDateDAO {
    public function findById(int $id): ?FormationDate;
    public function findAll(): array;
    public function save(FormationDate $formationDate): bool;
    public function update(FormationDate $formationDate): bool;
    public function delete(int $id): bool;
}
