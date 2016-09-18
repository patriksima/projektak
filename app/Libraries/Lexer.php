<?php

namespace App\Libraries;

/**
 * Lexer class.
 */
class Lexer
{
    protected $terminals = [
        'T_OPERATOR' => '/^(or|and)/',
        'T_KEY' => '/^([a-zA-Z]+)(?::)/',
        'T_VALUE' => '/^([a-zA-Z0-9]+)/',
        'T_SEPARATOR' => '/^(:)/',
        'T_WHITESPACE' => '/^(\s+)/',
        'T_OPENPAREN' => '/^(\()/',
        'T_CLOSEPAREN' => '/^(\))/',
    ];

    protected $input;
    protected $tokens = [];
    protected $current = 0;

    public function __construct($input)
    {
        $this->input = $input;
        $this->tokenize();
    }

    public function getState()
    {
        return $this->current;
    }

    public function setState($state)
    {
        $this->current = $state;
    }

    public function currentToken()
    {
        return $this->tokens[$this->current];
    }

    public function nextToken()
    {
        return (array_key_exists($this->current + 1, $this->tokens))
            ? $this->tokens[++$this->current]
            : false;
    }

    public function prevToken()
    {
        return (array_key_exists($this->current - 1, $this->tokens))
            ? $this->tokens[--$this->current]
            : false;
    }

    public function reset()
    {
        $this->current = -1;
    }

    protected function match($line, $offset)
    {
        $string = substr($line, $offset);

        foreach ($this->terminals as $name => $pattern) {
            if (preg_match($pattern, $string, $matches)) {
                return new Token($name, $matches[1]);
            }
        }

        return false;
    }

    protected function tokenize()
    {
        $line = $this->input;
        $offset = 0;

        while ($offset < mb_strlen($line)) {
            $token = $this->match($line, $offset);
            if ($token === false) {
                throw new Exception('Cannot match any known terminal.');
            }
            $this->tokens[] = $token;
            $offset += mb_strlen($token->value);
        }
    }
}
