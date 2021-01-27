<?php

namespace App\Entity;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchAdminReports extends AbstractController
{
    private ?User $userSelected = null;

    /**
     * @return User
     */
    public function getUserSelected(): ?User
    {
        return $this->userSelected;
    }

    /**
     * @param User $userSelected
     */
    public function setUserSelected(User $userSelected): void
    {
        $this->userSelected = $userSelected;
    }
}
