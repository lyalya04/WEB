<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новости — RabbitMQ</title>
</head>
<body>
    <h1>Добавить новость в очередь</h1>
    <form action="send.php" method="POST">
        <p><input type="text" name="title" placeholder="Заголовок новости" required></p>
        <p><textarea name="content" placeholder="Текст новости" required></textarea></p>
        <p><input type="text" name="author" placeholder="Автор" required></p>
        <button type="submit">Отправить в очередь</button>
    </form>

    <?php
    if (file_exists('processed_rabbit.log')) {
        echo "<h2>Обработанные новости:</h2><ul>";
        $lines = file('processed_rabbit.log');
        foreach ($lines as $line) {
            $data = json_decode($line, true);
            echo "<li><b>{$data['title']}</b> — {$data['author']} ({$data['timestamp']})</li>";
        }
        echo "</ul>";
    }
    ?>
</body>
</html>