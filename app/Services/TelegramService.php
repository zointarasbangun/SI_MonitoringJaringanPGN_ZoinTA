<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    protected $botToken;
    protected $chatId;

    public function __construct()
    {
        $this->botToken = config('services.telegram.bot_token');
        $this->chatId = config('services.telegram.channel_id');

        Log::info('Bot Token from config: ' . $this->botToken);
        Log::info('Chat ID from config: ' . $this->chatId);
    }



    public function sendMessage($message)
    {
        $client = new Client();
        $url = "https://api.telegram.org/bot{$this->botToken}/sendMessage";

        // Log the URL to make sure it is correct
        Log::info('Telegram URL: ' . $url);

        try {
            $response = $client->post($url, [
                'form_params' => [
                    'chat_id' => $this->chatId,
                    'text' => $message
                ]
            ]);

            return $response;
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Error sending message to Telegram: ' . $e->getMessage());
            return null;
        }
    }
}
