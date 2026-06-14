<?php
interface FormationDAO {
    public function getAll(): array;
    public function getById(int $id): ?Formation;
    public function create(Formation $formation): bool;
    public function update(Formation $formation): bool;
    public function delete(int $id): bool;

    /**
     * Get filtered formations by pays_id, ville_id, and/or search term.
     * Filters array can have keys: 'pays_id', 'ville_id', 'search'
     */
    public function getFiltered(array $filters): array;


}
