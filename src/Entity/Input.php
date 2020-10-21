<?php

namespace App\Entity;


class Input
{
    private $json;

    public function setJson(string $json): self
    {
        $this->json = $json;

        return $this;
    }
}