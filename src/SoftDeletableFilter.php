<?php

declare(strict_types=1);

namespace App;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;
use Doctrine\ORM\Version;

if (\class_exists(Version::class)) {
    // Doctrine ORM < 3.0.0
    final class SoftDeletableFilter extends SQLFilter
    {
        use SoftDeletableFilterTrait;

        public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias): string
        {
            return $this->doAddFilterConstraint($targetEntity, $targetTableAlias);
        }
    }
} else {
    // Doctrine ORM >= 3.0.0
    final class SoftDeletableFilter extends SQLFilter
    {
        use SoftDeletableFilterTrait;

        public function addFilterConstraint(ClassMetadata $targetEntity, string $targetTableAlias): string
        {
            return $this->doAddFilterConstraint($targetEntity, $targetTableAlias);
        }
    }
}
