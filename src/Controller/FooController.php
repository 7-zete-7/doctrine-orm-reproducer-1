<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\FooEntity;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FooController extends AbstractController
{
    #[Route(path: '/foo/{id}', name: 'foo_index', format: 'json')]
    public function index(#[MapEntity] FooEntity $entity): Response
    {
        $message = \sprintf('found #%d entity', $entity->getId());

        if (null !== $deletedAt = $entity->getDeletedAt()) {
            $message .= \sprintf(', scheduled to be deleted at %s', $deletedAt->format('Y-m-d\TH:i:sP'));
        }

        return $this->json([
            'message' => $message,
        ]);
    }
}
