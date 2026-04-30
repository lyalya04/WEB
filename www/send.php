<?php
require 'vendor/autoload.php';
require 'QueueManager.php';

$q = new QueueManager();
$q->publish([
    'title'     => $_POST['title'] ?? 'Без заголовка',
    'content'   => $_POST['content'] ?? '',
    'author'    => $_POST['author'] ?? '',
    'timestamp' => date('Y-m-d H:i:s')
]);

echo "✅ Новость отправлена в очередь!";