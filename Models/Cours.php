<?php

class Cours {
    public ?int $id;
    public string $cours_name;
    public ?string $content;
    public ?string $description;
    public ?string $audience;
    public ?int $duration;
    public bool $testIncluded;
    public ?string $testContent;
    public ?string $logo;
    public ?int $sujet_id;

    public function __construct(
        ?int $id,
        string $cours_name,
        ?string $content = null,
        ?string $description = null,
        ?string $audience = null,
        ?int $duration = null,
        bool $testIncluded = false,
        ?string $testContent = null,
        ?string $logo = null,
        ?int $sujet_id = null
    ) {
        $this->id = $id;
        $this->cours_name = $cours_name;
        $this->content = $content;
        $this->description = $description;
        $this->audience = $audience;
        $this->duration = $duration;
        $this->testIncluded = $testIncluded;
        $this->testContent = $testContent;
        $this->logo = $logo;
        $this->sujet_id = $sujet_id;
    }
}
