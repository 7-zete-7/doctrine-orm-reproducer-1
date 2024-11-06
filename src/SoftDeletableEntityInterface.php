<?php

declare(strict_types=1);

namespace App;

interface SoftDeletableEntityInterface
{
    public function getDeletedAt(): ?\DateTimeImmutable;
}
