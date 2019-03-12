<?php

namespace App\Math\TerminalExpression;

use App\Math\Stack\Stack;
use App\Math\Expressions\Number\Number;
use App\Math\Expressions\Addition\Addition;
use App\Math\Expressions\Subtraction\Subtraction;
use App\Math\Expressions\Multiplication\Multiplication;
use App\Math\Expressions\Division\Division;
use App\Math\Expressions\Parenthesis\Parenthesis;

abstract class TerminalExpression
{
    protected $value = '';

    /**
     * TerminalExpression constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param $value
     * @return Addition|Division|Multiplication|Number|Parenthesis|Subtraction|mixed
     * @throws \Exception
     */
    public static function factory($value)
    {
        if (is_object($value) && $value instanceof TerminalExpression) {
            return $value;
        } elseif (is_numeric($value)) {
            return new Number($value);
        } elseif ($value == '+') {
            return new Addition($value);
        } elseif ($value == '-') {
            return new Subtraction($value);
        } elseif ($value == '*') {
            return new Multiplication($value);
        } elseif ($value == '/') {
            return new Division($value);
        } elseif (in_array($value, array('(', ')'))) {
            return new Parenthesis($value);
        }
        throw new \Exception('Undefined Value ' . $value);
    }

    /**
     * @param Stack $stack
     * @return mixed
     */
    abstract public function operate(Stack $stack);

    /**
     * @return bool
     */
    public function isOperator()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isParenthesis()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isNoOp()
    {
        return false;
    }

    /**
     * @return string
     */
    public function render()
    {
        return $this->value;
    }
}