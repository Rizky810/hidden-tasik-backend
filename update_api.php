<?php
$file = '../hidden-tasik-frontend-main/api.js';
$content = file_get_contents($file);
$content = str_replace('/wisata', '/destinations', $content);
$content = str_replace('/gallery', '/galleries', $content);
file_put_contents($file, $content);
echo "API endpoints updated.";
