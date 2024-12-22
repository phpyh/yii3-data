<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\App;

use VUdaltsov\Yii3DataExperiment\Admin\Admin;
use VUdaltsov\Yii3DataExperiment\Data\CallableEntityValueProvider;
use VUdaltsov\Yii3DataExperiment\Data\EntityConfig;
use VUdaltsov\Yii3DataExperiment\Data\FieldConfig;
use VUdaltsov\Yii3DataExperiment\Data\InMemoryRepository;
use VUdaltsov\Yii3DataExperiment\Data\Property;

require_once __DIR__ . '/../../vendor/autoload.php';

$userProfiles = new InMemoryRepository([
    new UserProfile(1, 'vudaltsov', 'Валентин', 'Удальцов', new \DateTimeImmutable('22.05.1994')),
    new UserProfile(2, 'roxblnfk', 'Алексей', 'Гагарин', new \DateTimeImmutable('29.02.2222')),
]);
$admin = new Admin([
    new EntityConfig('User Profile', $userProfiles, [
        FieldConfig::property(UserProfile::class, 'id'),
        new FieldConfig('Никнейм', new Property(UserProfile::class, 'nickname')),
        new FieldConfig('Имя', new CallableEntityValueProvider(
            static fn(UserProfile $profile): string => "{$profile->firstName} {$profile->lastName}",
        )),
        FieldConfig::property(UserProfile::class, 'birthday'),
    ]),
]);
$admin->displayList('User Profile');
