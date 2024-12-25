<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\App;

use VUdaltsov\Yii3DataExperiment\Admin\Admin;
use VUdaltsov\Yii3DataExperiment\Data\EntityConfig;
use VUdaltsov\Yii3DataExperiment\Data\InMemoryRepository;
use VUdaltsov\Yii3DataExperiment\Data\ListColumnConfig;
use VUdaltsov\Yii3DataExperiment\Data\ListConfig;
use VUdaltsov\Yii3DataExperiment\Data\OffsetPaginator;
use VUdaltsov\Yii3DataExperiment\Data\Sort;
use VUdaltsov\Yii3DataExperiment\Data\SortDirection;

require_once __DIR__ . '/../../vendor/autoload.php';

$userProfiles = [
    new UserProfile(3, 'samdark', 'Александр', 'Макаров', new \DateTimeImmutable('12.03.1992')),
    new UserProfile(1, 'vudaltsov', 'Валентин', 'Удальцов', new \DateTimeImmutable('22.05.1994')),
    new UserProfile(2, 'roxblnfk', 'Алексей', 'Гагарин', new \DateTimeImmutable('29.02.2222')),
];
$repository = new InMemoryRepository($userProfiles);
$admin = new Admin([
    new EntityConfig(
        name: 'Профиль',
        list: new ListConfig(
            name: 'Профили',
            paginator: new OffsetPaginator($repository, pageSize: 2),
            columns: [
                ListColumnConfig::fromField('id', 'ID'),
                ListColumnConfig::fromField('nickname', 'Никнейм'),
                new ListColumnConfig(
                    name: 'Имя',
                    value: static fn(UserProfile $profile): string => "{$profile->firstName} {$profile->lastName}",
                    ascSort: new Sort([
                        'firstName' => SortDirection::Asc,
                        'lastName' => SortDirection::Asc,
                    ]),
                ),
                ListColumnConfig::fromField('birthday', 'День рождения'),
            ],
        ),
    ),
]);
$admin->displayList('Профиль');
