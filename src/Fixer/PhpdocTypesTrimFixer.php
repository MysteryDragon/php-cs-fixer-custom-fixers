<?php declare(strict_types=1);

/*
 * This file is part of PHP CS Fixer: custom fixers.
 *
 * (c) 2018 Kuba Werłos
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace PhpCsFixerCustomFixers\Fixer;

use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Preg;

final class PhpdocTypesTrimFixer extends AbstractTypesFixer
{
    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition(
            'PHPDoc types must be trimmed.',
            [new CodeSample('<?php
/**
 * @param null | string $x
 */
function foo($x) {}
')]
        );
    }

    /**
     * Must run before NoSuperfluousPhpdocTagsFixer, PhpdocAlignFixer.
     */
    public function getPriority(): int
    {
        return 7;
    }

    protected function fixType(string $type): string
    {
        return Preg::replace('/\h*(&|\|)\h*/', '$1', $type);
    }
}
