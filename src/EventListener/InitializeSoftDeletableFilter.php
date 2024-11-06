<?php

declare(strict_types=1);

namespace App\EventListener;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Filter\SQLFilter;
use Symfony\Component\Clock\ClockInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;

#[AsEventListener]
class InitializeSoftDeletableFilter
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly ClockInterface $clock,
        private readonly string $filterName = 'soft_deletable',
    ) {
    }

    public function __invoke(RequestEvent $event): void
    {
        if (null === $filter = $this->findTargetFilter()) {
            return;
        }

        $now = $this->clock->now();

        $filter->setParameter('now', $now, Types::DATETIME_IMMUTABLE);
    }

    private function findTargetFilter(): ?SQLFilter
    {
        $filters = $this->entityManager->getFilters();

        return $filters->isEnabled($this->filterName) ? $filters->getFilter($this->filterName) : null;
    }
}
