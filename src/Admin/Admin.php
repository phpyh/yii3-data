<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Admin;

use Twig\Environment;
use Twig\Error\Error;
use Twig\Loader\FilesystemLoader;
use VUdaltsov\Yii3DataExperiment\Data\EntityConfig;
use VUdaltsov\Yii3DataExperiment\Formatter;

/**
 * @api
 * @template TEntity of array|object
 */
final readonly class Admin
{
    /**
     * @var array<non-empty-string, EntityConfig<TEntity>>
     */
    private array $entityConfigsByName;

    /**
     * @param list<EntityConfig<TEntity>> $entityConfigs
     */
    public function __construct(
        array $entityConfigs = [],
        private Environment $twig = new Environment(
            new FilesystemLoader(__DIR__),
            [
                'debug' => true,
                'strict_variables' => true,
            ],
        ),
        private Formatter\Formatter $formatter = new Formatter\Formatters([
            new Formatter\StringableFormatter(),
            new Formatter\ScalarFormatter(),
            new Formatter\DateTimeFormatter(),
        ]),
    ) {
        $this->entityConfigsByName = array_column($entityConfigs, null, 'name');
    }

    /**
     * @param non-empty-string $entityName
     * @throws Error
     */
    public function displayList(string $entityName): void
    {
        $entityConfig = $this->entityConfigsByName[$entityName]
            ?? throw new \RuntimeException(\sprintf('No entity "%s"', $entityName));

        $this->twig->display('list.twig', [
            'list' => $entityConfig->list,
            'entities' => $entityConfig->repository->query(),
            'formatter' => $this->formatter,
        ]);
    }
}
