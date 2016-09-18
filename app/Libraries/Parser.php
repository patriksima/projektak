<?php

namespace App\Libraries;

class Literal
{
    protected $term;
    protected $lexer;
    protected $options = [];

    public function __construct(Lexer $lexer, string $term)
    {
        $this->term = $term;
        $this->lexer = $lexer;
        $this->options[] = $term;
    }

    public function parse()
    {
        if (empty($this->options)) return null;

        $token = $this->lexer->currentToken();
        $option = array_pop($this->options);

        if ($token) {
            $result = ($option == $token->name);
        } else {
            $result = ($option == 'T_EOF');
        }

        if ( $result) {
            $this->lexer->nextToken();
        } else {
            array_push($this->options, $option);
        }

        //dump("Literal::parse(): ".var_export($option,true).": ".var_export($token->name,true));
        return $result;
    }
}

class Term
{
    protected $term;
    protected $parser;

    public function __construct(Parser $parser, string $term)
    {
        $this->parser = $parser;
        $this->term = $this->parser->factoryTerm($this->parser->grammar[$term]);
    }

    public function parse()
    {
        //dump("Term::parse(".var_export(get_class($this->term),true).")");
        return $this->term->parse();
    }
}

class Terms
{
    protected $options = [];
    protected $previous;
    protected $parser;
    static $c = 10;

    public function __construct(Parser $parser, string $terms)
    {
        $this->parser = $parser;

        preg_match_all('/(<[^>]+>)/i', $terms, $matches);

        foreach (array_reverse($matches[1]) as $term) {
            $this->options[] = [
                'name' => $term,
                'class' => $this->parser->factoryTerm($term)
            ];
        };
    }

    /**
     * AND mode.
     */
    public function parse()
    {
        $result = null;
        //$state = $this->parser->lexer->getState();
        while (!empty($this->options)) {
            $state = $this->parser->lexer->getState();
            $option = array_pop($this->options);

            //dump(str_repeat('    ',self::$c)."Terms::parse(".var_export(get_class($option['class']),true)."): ".var_export($option['name'],true).' {');
            self::$c++;
            $result = $option['class']->parse();
            self::$c--;
            //dump(str_repeat('    ',self::$c).'}, '.var_export($result,true));

            if (is_null($result)) {
                return null;
            }

            if (!$result && empty($this->previous)) {
                return null;
            }

            if ($result) {
                $this->previous = $option;
                $this->previousState = $state;
            } else {
                array_push($this->options, $option);
                array_push($this->options, $this->previous);
                $this->previous = null;

                //dump('options: '. var_export($this->options,true));
                //dd($this->options);
                $this->parser->lexer->setState($this->previousState);
                //$this->previousState = null;
            }

        }
        //$this->parser->lexer->setState($state);

        return $result;
    }
}

class Expression
{
    public $options = [];
    protected $parser;
    static $c = 5;

    public function __construct(Parser $parser, array $terms)
    {
        $this->parser = $parser;
        $this->options = array_reverse($terms);
    }

    /**
     * OR mode.
     */
    public function parse()
    {
        while (!empty($this->options)) {
            $state = $this->parser->lexer->getState();
            $term = array_pop($this->options);

            //dump(str_repeat('    ',self::$c)."Expression::parse(): ".var_export($term,true).' {');
            self::$c++;
            $result = $this->parser->factoryTerm($term)->parse();
            self::$c--;
            //dump(str_repeat('    ',self::$c).'}, '.var_export($result,true));
            //dump("Expression::parse(): ".var_export($term,true).": ".var_export($result,true));

            //if (is_null($result)) return null;
            if ($result) {
                    return true;
            }
            $this->parser->lexer->setState($state);
        }

        return false;
    }
}

/**
 * Parser class.
 */
class Parser
{
    public $lexer;
    public $grammar = [
        '<operator>' => '<ws><op><ws>',
        '<separator>' => 'T_SEPARATOR',
        '<key>' => 'T_KEY',
        '<value>' => 'T_VALUE',
        '<lp>' => 'T_OPENPAREN',
        '<ws>' => 'T_WHITESPACE',
        '<op>' => 'T_OPERATOR',
        '<rp>' => 'T_CLOSEPAREN',
        '<term>' => '<key><separator><value>',
        '<terms>' => ['<term>', '<term><operator><terms>'],
        '<exp>' => ['<terms>', '<terms><operator><exp>', '<lp><exp><rp>'],
    ];
    protected $start = '<exp>';
    protected $tree, $stack = [];

    public function __construct(Lexer $lexer)
    {
        $this->lexer = $lexer;
        //$this->convertGrammar();
    }

    public function parse()
    {
        /*
        (key:value or key:value) and key:value
        <lp>
            <exp><operator><exp>
        <rp>
        <operator>
        <exp>
        */
        return (new Expression($this,$this->grammar[$this->start]))->parse();
        //return $this->matchTerms($this->grammar[$this->start]);
    }
/*
    protected function convertGrammar()
    {
        foreach ($this->grammar as $key => $value) {
            if (is_array($value)) {
                $this->tree[] = new Expression($key, $value);
                continue;
            }

            if ($this->isToken($value)) {
                $this->tree[] = new Literal($key, $value);
                continue;
            }

            if ($this->isTerm($value)) {
                $this->tree[] = new Term($key, $value);
                continue;
            }

            if ($this->areTerms($value)) {
                $this->tree[] = new Terms($key, $value);
                continue;
            }
        }
        dd($this->tree);
    }*/

    protected function isToken($term)
    {
        return preg_match('/^T_[A-Z]+$/', $term);
    }

    protected function isTerm($term)
    {
        return preg_match('/^(<[^>]+>)$/i', $term);
    }

    protected function areTerms($term)
    {
        return preg_match('/^(<[^>]+>){2,}$/i', $term);
    }

    public function factoryTerm($terms)
    {
        //dump($terms);
        if (is_array($terms)) {
            return new Expression($this, $terms);
        }
        if ($this->isToken($terms)) {
            return new Literal($this->lexer, $terms);
        }
        if ($this->isTerm($terms)) {
            //dd('isTerm');
            return new Term($this, $terms);
        }
        if ($this->areTerms($terms)) {
            return new Terms($this, $terms);
        }
    }

    public function matchTerms($terms)
    {
        //dump($terms);
        // OR operator
        if (is_array($terms)) {
            return (new Expression($this, $terms))->parse();
        }

        if ($this->isToken($terms)) {
            $token = $this->lexer->currentToken();

            if ($token) {
                $result = ($terms == $token->name);
            } else {
                $result = ('T_EOF' == $terms);
            }

            $this->lexer->nextToken();

            //dump("{$terms}=={$token->name}: ".(($result)?'true':'false'));
            return $result;
        }

        if ($this->isTerm($terms)) {
            $result = $this->matchTerms($this->grammar[$terms]);
            //dump("{$terms}: ".(($result)?'true':'false'));
            return $result;
        }

        if ($this->areTerms($terms)) {
            return (new Terms($this, $terms))->parse();
        }

        return true;
    }
}
