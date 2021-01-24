<?php

declare(strict_types=1);

namespace Symplify\PHPStanRules\Tests\Rules\NoNestedArrayFuncCallRule;

use Iterator;
use PHPStan\Rules\Rule;
use Symplify\PHPStanExtensions\Testing\AbstractServiceAwareRuleTestCase;
use Symplify\PHPStanRules\Rules\NoNestedArrayFuncCallRule;

final class NoNestedArrayFuncCallRuleTest extends AbstractServiceAwareRuleTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function testRule(string $filePath, array $expectedErrorMessagesWithLines): void
    {
        $this->analyse([$filePath], $expectedErrorMessagesWithLines);
    }

    public function provideData(): Iterator
    {
        yield [__DIR__ . '/Fixture/SkipNonNested.php', []];
        yield [__DIR__ . '/Fixture/NestedFuncCall.php', [[NoNestedArrayFuncCallRule::ERROR_MESSAGE, 11]]];
    }

    protected function getRule(): Rule
    {
        return $this->getRuleFromConfig(
            NoNestedArrayFuncCallRule::class,
            __DIR__ . '/../../../config/symplify-rules.neon'
        );
    }
}
