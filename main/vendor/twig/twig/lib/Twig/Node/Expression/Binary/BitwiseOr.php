<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 * (c) Armin Ronacher
 *
 * For the full copyright and license information, please views the LICENSE
 * file that was distributed with this source code.
 */
class Twig_Node_Expression_Binary_BitwiseOr extends Twig_Node_Expression_Binary
{
    public function operator(Twig_Compiler $compiler)
    {
        return $compiler->raw('|');
    }
}

class_alias('Twig_Node_Expression_Binary_BitwiseOr', 'Twig\Node\Expression\Binary\BitwiseOrBinary', false);