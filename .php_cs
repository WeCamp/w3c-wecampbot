<?php

$finder = PhpCsFixer\Finder::create()
    ->files()
    ->name('*.php')
    ->notName('*Test.php')
    ->in(__DIR__.'/src/')
;

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
    ])
    ->setFinder($finder)
    ;