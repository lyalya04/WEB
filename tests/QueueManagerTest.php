<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../QueueManager.php';

interface ChannelInterface {
    public function basic_publish($msg, $exchange, $queue);
    public function basic_consume($queue, $tag, $noLocal, $noAck, $exclusive, $noWait, $callback);
    public function is_consuming();
}

class QueueManagerTest extends TestCase
{
    private $channelMock;
    private QueueManager $queueManager;

    protected function setUp(): void
    {
        $this->channelMock = $this->createMock(ChannelInterface::class);
        $this->queueManager = new QueueManager($this->channelMock);
    }

    // Unit-тест 1 — добавление данных
    public function testPublishReturnsTitle()
    {
        $result = $this->queueManager->publish([
            'title'   => 'Тестовая новость',
            'content' => 'Контент',
            'author'  => 'Автор',
        ]);

        $this->assertEquals('Message published: Тестовая новость', $result);
    }

    // Unit-тест 2 — получение имени очереди
    public function testGetQueueName()
    {
        $result = $this->queueManager->getQueueName();

        $this->assertEquals('lab7_queue', $result);
    }

    // Тест с Mock
    public function testPublishWithMock()
    {
        $this->channelMock
            ->expects($this->once())
            ->method('basic_publish');

        $this->queueManager->publish([
            'title'   => 'Mock новость',
            'content' => 'Текст',
            'author'  => 'Автор',
        ]);
    }
}