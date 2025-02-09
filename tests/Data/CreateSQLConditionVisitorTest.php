<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use VUdaltsov\Yii3DataExperiment\Data\Filter\AndX;
use VUdaltsov\Yii3DataExperiment\Data\Filter\Equals;
use VUdaltsov\Yii3DataExperiment\Data\Filter\Field;
use VUdaltsov\Yii3DataExperiment\Data\Filter\None;
use function PHPUnit\Framework\assertEquals;

#[CoversClass(CreateSQLConditionVisitor::class)]
final class CreateSQLConditionVisitorTest extends TestCase
{
    #[TestWith([None::Filter, new SQLCondition('false')])]
    #[TestWith([new Equals(new Field('foo'), 1), new SQLCondition('foo = :p0', ['p0' => 1])])]
    #[TestWith([new Equals(new Field('foo'), new Field('bar')), new SQLCondition('foo = bar')])]
    #[TestWith([new Equals('foo', 'bar'), new SQLCondition(':p0 = :p1', ['p0' => 'foo', 'p1' => 'bar'])])]
    #[TestWith([
        new AndX([
            new Equals(new Field('foo'), 1),
            new Equals(new Field('bar'), 2),
        ]),
        new SQLCondition('foo = :p0 and bar = :p1', ['p0' => 1, 'p1' => 2]),
    ])]
    public function testBasic(Filter $filter, SQLCondition $expectedSQLCondition): void
    {
        $visitor = new CreateSQLConditionVisitor();

        $sqlCondition = $filter->accept($visitor);

        assertEquals($expectedSQLCondition, $sqlCondition);
    }
}
