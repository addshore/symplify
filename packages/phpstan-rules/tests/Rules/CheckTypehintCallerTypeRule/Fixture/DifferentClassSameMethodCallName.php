<?php

declare(strict_types=1);

namespace Symplify\PHPStanRules\Tests\Rules\CheckTypehintCallerTypeRule\Fixture;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use Symplify\PHPStanRules\Tests\Rules\PreferredClassRule\Fixture\StaticCall;

class DifferentClassSameMethodCallName
{
    /**
     * @param StaticCall|MethodCall $node
     */
    public function process(AnotherClass $node)
    {
        $node->run($node);
    }

    /**
     * @param StaticCall|MethodCall $node
     */
    private function run(Node $node)
    {
        if ($node->name instanceof MethodCall) {
            $this->run($node->name);
        }
    }
}