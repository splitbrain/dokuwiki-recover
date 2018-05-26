#!/usr/bin/php
<?php

$phpfiles = array(
    'Check.php',
    'Recover.php',
);

$htmls = glob('html/*.html');

// header
$source = "<?php\n";
$source = "// built " . date('Y-m-d H:I:s') . "\n";
$source = "define('ISBUILD', true);\n";

foreach ($phpfiles as $file) {
    $content = file_get_contents($file);
    $content = preg_replace('/^<?php/', '', $content);
    $source .= $content;
}

foreach ($htmls as $file) {
    $name = '__' . strtoupper(basename($file, '.html')) . '__';
    $html = file_get_contents($file);
    $html = addslashes($html);
    $source = str_replace($name, $html, $source);
}

// main
$source .= "\n\n";
$source .= "\$recover = new Recover();\n";
$source .= "\$recover->run();\n";

file_put_contents('dokuwiki-recover.php', $source);






