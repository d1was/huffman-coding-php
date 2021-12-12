<?php

class Huffman
{

    private $codes = [];

    public function compress($data)
    {
        $symbolsWithFrequency = $this->computeFrequency($data);

        $trees = [];
        foreach ($symbolsWithFrequency as $symbol => $frequency) {
            $trees[] = new Node($symbol, $frequency);
        }

        while(count($trees) > 1) {
            usort($trees, function($first, $second) {
                return $first->frequency > $second->frequency;
            });

            $leftNode = $trees[0];
            $rightNode = $trees[1];

            $leftNode->code = 0;
            $rightNode->code = 1;

            $newNode = new Node($leftNode->symbol . $rightNode->symbol, $leftNode->frequency + $rightNode->frequency, $leftNode, $rightNode );

            array_splice($trees, 0, 2);
            $trees[] = $newNode;

        }

        $this->calculateCodes($trees[0]);
        return $this->codes;
    }

    private function computeFrequency($data)
    {
        $symbols = [];
        foreach (str_split($data) as $symbol)
        {
            isset($symbols[$symbol]) ? $symbols[$symbol] += 1 : $symbols[$symbol] = 1;
        }

        return $symbols;
    }

    private function calculateCodes($node, $value = "")
    {
        $newvalue = $value . $node->code;

        if($node->left) {
            $this->calculateCodes($node->left, $newvalue);
        }

        if($node->right) {
            $this->calculateCodes($node->right, $newvalue);
        }

        if(! ($node->left AND $node->right) ) {
            $this->codes[$node->symbol] = $newvalue;
        }

    }
}