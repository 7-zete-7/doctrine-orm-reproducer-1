# Doctrine ORM issue reproducer

This reproducer is made to demonstrate a issue in the `SQLFilter` class,
which is part of the `doctrine/orm` package.

There is no issue in version 2,
but in version 3 an issue appears with an unclear cause.

## Setup

### Requirements
- Composer
- `sqlite` PHP extension

### Initialize reproducer

```shell
$ composer install
$ bin/console doctrine:migrations:migrate --no-interaction --all-or-nothing
$ bin/console doctrine:fixtures:load --no-interaction
```

## Steps to reproduce

To reproduce this, a filter `SortDeletableFilter`
and a test `FooControllerTest` were written.

This test will be run against different versions of the `doctrine/orm` package.

### Doctrine ORM 2

With this version of the package the issue does not occur.

#### Setup package version

```shell
$ composer require doctrine/orm:~2
```

#### Start a test

```shell
$ bin/phpunit
```

### Doctrine ORM 3

The problem occurs with this version of the package.

#### Setup package version

```shell
$ composer require doctrine/orm:~3
```

#### Start a test

```shell
$ bin/phpunit
```
