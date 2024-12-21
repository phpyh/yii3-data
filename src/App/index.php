<?php

declare(strict_types=1);

namespace Yii3DataStream\App;

use Yii3DataStream\Admin\Admin;
use Yii3DataStream\Data\CallableFieldFormatter;
use Yii3DataStream\Data\EntityConfig;
use Yii3DataStream\Data\FieldConfig;
use Yii3DataStream\Data\InMemoryRepository;
use Yii3DataStream\Data\PropertyFieldFormatter;

require_once __DIR__ . '/../../vendor/autoload.php';

$userProfiles = new InMemoryRepository([
    new UserProfile(1, 'vudaltsov', 'Валентин', 'Удальцов'),
    new UserProfile(2, 'agagarin', 'Алексей', 'Гагарин'),
]);
$admin = new Admin([
    new EntityConfig('User Profile', $userProfiles, [
        new FieldConfig('ID', new PropertyFieldFormatter(UserProfile::class, 'id')),
        new FieldConfig('Никнейм', new PropertyFieldFormatter(UserProfile::class, 'nickname')),
        new FieldConfig('Имя', new CallableFieldFormatter(
            static fn(UserProfile $profile): string => \sprintf('%s %s', $profile->firstName, $profile->lastName),
        )),
    ]),
]);
$admin->displayList('User Profile');
