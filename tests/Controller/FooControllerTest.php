<?php

declare(strict_types=1);

namespace App\Test\Controller;

use App\DataFixtures\AppFixtures;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class FooControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testNonDeletedFoo(): void
    {
        $this->client->jsonRequest('GET', self::createFooUrl(AppFixtures::FOO_ID_NON_DEPETED));

        $this->assertResponseIsSuccessful();
    }

    public function testAlreadyDeletedFoo(): void
    {
        $this->client->jsonRequest('GET', self::createFooUrl(AppFixtures::FOO_ID_ALREADY_DELETED));

        $this->assertResponseStatusCodeSame(404);
    }

    public function testScheduleDeletedFoo(): void
    {
        $this->client->jsonRequest('GET', self::createFooUrl(AppFixtures::FOO_ID_SCHEDULE_DELETED));

        $this->assertResponseIsSuccessful();
    }

    private static function createFooUrl(int $fooId): string
    {
        return \sprintf('/foo/%d', $fooId);
    }
}
