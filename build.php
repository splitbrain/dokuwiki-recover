#!/usr/bin/php
<?php

$phpfiles = array(
    'Check.php',
    'Recover.php',
    'GUI.php'
);

$htmls = glob('html/*.html');
$styles = glob('css/*.css');
sort($styles);

// header
$source = "<?php\n";
$source .= "// built " . date('Y-m-d H:I:s') . "\n";
$source .= "define('ISBUILD', true);\n";

foreach ($phpfiles as $file) {
    $content = file_get_contents($file);
    $content = preg_replace('/^<\?php/', '', $content);
    $source .= $content;
}

foreach ($htmls as $file) {
    $name = '__' . strtoupper(basename($file, '.html')) . '__';
    $html = file_get_contents($file);
    $html = addcslashes($html, "'");
    $source = str_replace($name, $html, $source);
}

$css = '';
foreach ($styles as $file) {
    $css .= addcslashes(file_get_contents($file), "'");
}
$source = str_replace('__STYLES__', $css, $source);


// main
$source .= "\n\n";
$source .= "\$gui = new GUI();\n";
$source .= "\$gui->run();\n";

file_put_contents('dokuwiki-recover.php', $source);
system('php -l dokuwiki-recover.php');






