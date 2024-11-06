<?php

declare(strict_types=1);

namespace App;

use Doctrine\ORM\Mapping\ClassMetadata;

trait SoftDeletableFilterTrait
{
    private const string FIELD_NAME = 'deletedAt';

    private function doAddFilterConstraint(ClassMetadata $targetEntity, string $targetTableAlias): string
    {
        if (!is_a($targetEntity->getName(), SoftDeletableEntityInterface::class, true)) {
            return '';
        }
        if (!$targetEntity->hasField(self::FIELD_NAME)) {
            return '';
        }

        $column = $targetTableAlias.'.'.$targetEntity->getColumnName(self::FIELD_NAME);
        $now = $this->getParameter('now');

        return $column.' IS NULL OR '.$column.' > '.$now;
    }
}
