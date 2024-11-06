<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\FooEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class AppFixtures extends Fixture
{
    public const int FOO_ID_NON_DEPETED = 1;
    public const int FOO_ID_ALREADY_DELETED = 2;
    public const int FOO_ID_SCHEDULE_DELETED = 3;

    public function load(ObjectManager $manager): void
    {
        $nonDeletedFoo = new FooEntity(self::FOO_ID_NON_DEPETED);
        $manager->persist($nonDeletedFoo);

        $alreadyDeletedFoo = new FooEntity(self::FOO_ID_ALREADY_DELETED, new \DateTimeImmutable('2024-11-06T20:00:59Z'));
        $manager->persist($alreadyDeletedFoo);

        $scheduleDeletedFoo = new FooEntity(self::FOO_ID_SCHEDULE_DELETED, new \DateTimeImmutable('2036-02-17T07:00:00Z'));
        $manager->persist($scheduleDeletedFoo);

        $manager->flush();
    }
}
