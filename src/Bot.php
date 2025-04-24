<?php

declare(strict_types=1);

namespace App;

use App\Repository\CountryRepository;
use App\Repository\UserRepository;
use App\Service\CountryService;
use App\Service\UserService;

class Bot
{
    public function __construct(private array $config)
    {}

    public function handle()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['message']['text'])) {
            $message = $input['message'];
            $chatId = $message['chat']['id'];
            $text = $message['text'];

            switch ($text) {
                case '/getCountries':
                    $this->handleGetCountries($chatId);
                    break;
                case '/getUser':
                    $this->handleGetUser($chatId);
                    break;
                default:
                    $this->sendMessage($chatId, 'Нет такой команды');
            }
        }
        http_response_code(200);
    }

    private function handleGetCountries($chatId)
    {
        $countryService = new CountryService(
            new CountryRepository(
                $this->config['leads_su']['api_token'],
                $this->config['leads_su']['countries_url']
            )
        );

        $countries = $countryService->getLast10Countries();
        $message = "Последние 10 стран из запроса:\n";

        foreach ($countries as $country) {
            $message .= "{$country->id} " . "{$country->name}\n";
        }

        $this->sendMessage($chatId, $message);
    }

    private function handleGetUser($chatId)
    {
        $userService = new UserService(
            new UserRepository(
                $this->config['leads_su']['api_token'],
                $this->config['leads_su']['user_url']
            )
        );

        $user = $userService->getUserInfo();
        $message = "Инфо о текущем пользователе:\n" . "{$user->id} " . "{$user->name}";;

        $this->sendMessage($chatId, $message);
    }

    private function sendMessage($chatId, $text)
    {
        $data = [
            'chat_id' => $chatId,
            'text' => $text
        ];

        file_get_contents(
            "https://api.telegram.org/bot{$this->config['telegram']['bot_token']}/sendMessage?" .
            http_build_query($data)
        );
    }
}