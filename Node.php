<?php

class Node
{
    public $frequency;

    public $left;

    public $right;

    public $symbol;

    public $code;

    public function __construct($symbol, $frequency, $left = null, $right = null)
    {
        $this->symbol = $symbol;
        $this->frequency = $frequency;
        $this->left = $left;
        $this->right = $right;
    }



}