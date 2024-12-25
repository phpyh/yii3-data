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
    private array $entitiesByName;

    /**
     * @param list<EntityConfig<TEntity>> $entities
     */
    public function __construct(
        array $entities = [],
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
        $this->entitiesByName = array_column($entities, null, 'name');
    }

    /**
     * @param non-empty-string $entityName
     * @throws Error
     */
    public function displayList(string $entityName): void
    {
        if (!isset($this->entitiesByName[$entityName])) {
            throw new \RuntimeException(\sprintf('No entity "%s"', $entityName));
        }

        $this->twig->display('list.twig', [
            'entity_config' => $this->entitiesByName[$entityName],
            'formatter' => $this->formatter,
        ]);
    }
}
