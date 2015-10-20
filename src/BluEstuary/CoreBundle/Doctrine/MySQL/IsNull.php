<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 25/09/15
 * Time: 01:27
 */

namespace BluEstuary\CoreBundle\Doctrine\MySQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode,
    Doctrine\ORM\Query\Lexer;

class IsNull extends FunctionNode
{

    public $expr;
    /**
     * @param \Doctrine\ORM\Query\SqlWalker $sqlWalker
     *
     * @return string
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return 'ISNULL(' . $sqlWalker->walkArithmeticPrimary(
            $this->expr
        ) . ')';
    }

    /**
     * @param \Doctrine\ORM\Query\Parser $parser
     *
     * @return void
     */
    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_CURLY_BRACE);

        $this->expr = $parser->ArithmeticPrimary();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}