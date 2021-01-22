<?php

namespace App\Entity;

class EventSearch
{

    private ?string $search = "";

    /**
     * @return string|null
     */
    public function getSearch(): ?string
    {
        return $this->search;
    }

    /**
     * @param string $search|null
     * @return EventSearch
     */
    public function setSearch(?string $search): EventSearch
    {
        $this->search = $search;
        return $this;
    }
}
