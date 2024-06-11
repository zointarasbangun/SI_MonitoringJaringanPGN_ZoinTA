<?php

namespace App\Services;

use GuzzleHttp\Client;

class TelegramService
{
    protected $botToken;
    protected $chatId;

    public function __construct()
    {
        $this->botToken = env('TELEGRAM_BOT_TOKEN');
        $this->chatId = env('TELEGRAM_CHANNEL_ID');
    }

    public function sendMessage($message)
    {
        $client = new Client();
        $url = "https://api.telegram.org/bot{$this->botToken}/sendMessage";

        $response = $client->post($url, [
            'form_params' => [
                'chat_id' => $this->chatId,
                'text' => $message
            ]
        ]);

        return $response;
    }
}
