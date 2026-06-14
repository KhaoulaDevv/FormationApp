<?php
class Sujet {
    public ?int $id;
    public string $sujet_name;
    public string $shortDescription;
    public string $longDescription;
    public string $individualBenefit;
    public string $businessBenefit;
    public string $logo;
    public int $domaine_id;
    public ?string $domaine_name; // Optional

    public function __construct(
        ?int $id,
        string $sujet_name,
        string $shortDescription,
        string $longDescription,
        string $individualBenefit,
        string $businessBenefit,
        string $logo,
        int $domaine_id,
        ?string $domaine_name = null
    ) {
        $this->id = $id;
        $this->sujet_name = $sujet_name;
        $this->shortDescription = $shortDescription;
        $this->longDescription = $longDescription;
        $this->individualBenefit = $individualBenefit;
        $this->businessBenefit = $businessBenefit;
        $this->logo = $logo;
        $this->domaine_id = $domaine_id;
        $this->domaine_name = $domaine_name;
    }
}