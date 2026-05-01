<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = new Finder()
  ->files()
  ->in([
    __DIR__ . '/src',
    __DIR__ . '/tests',
  ])
  ->name('*.php')
  ->exclude([
    'vendor',
  ]);

return new Config()
  ->setRiskyAllowed(false)
  ->setRules([
    '@PhpCsFixer' => true,
    '@auto' => true,
    '@auto:risky' => false,

      'octal_notation' => false,

    // Removes UTF-8 BOM
    'encoding' => true,

    'concat_space' => ['spacing' => 'one'],

    'global_namespace_import' => [
      'import_classes' => true,
      'import_constants' => true,
      'import_functions' => false,
    ],

    'native_function_invocation' => false,

    'ordered_imports' => [
      'sort_algorithm' => 'alpha',
    ],

    'no_leading_import_slash' => true,
    'single_import_per_statement' => true,
  ])
  ->setFinder($finder);