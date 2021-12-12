<?php

require "./Node.php";
require "./Huffman.php";

// Huffman Compression Algorithm

fwrite(STDOUT, "Enter text to compress: ");
$input = fgets(STDIN);

$algorithm = new Huffman();
$result = $algorithm->compress($input);

$output = [];
foreach (str_split($input) as $c) {
    $output[] = $result[$c];
}

$result = implode("", $output);

fwrite(STDOUT, "Compressed bit is : " . $result . "\n" );

// Exit correctly
exit(0);

?>