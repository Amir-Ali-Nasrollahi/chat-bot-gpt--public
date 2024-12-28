<?php

namespace Core;

abstract class Controller
{
	public static function DbConnection($table_name)
	{

		return new (ucfirst($table_name));
	}

	public function connection(array|string $data, string $address, string $auth = "")
	{
		$ch = curl_init($address);
		curl_setopt_array($ch, [
			CURLOPT_POST => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS => $data,
			// CURLOPT_HTTPHEADER => ["Content-Type: application/json", $auth],
		]);
		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}

	public function sendMessage(int $chat_id, string $text, array $keyboard = []): void
	{
		$this->connection([
			"chat_id" => $chat_id,
			"text" => $text,
			"reply_markup" => json_encode([
				"keyboard" => $keyboard,
				'resize_keyboard' => true,
				'is_persistent' => true
			])
		], TELEGRAM_URL);
	}

	public function useGPT()
	{
		$response = $this->connection(json_encode([
			'model' => 'gpt-4o-mini',
			'store' => true,
			'messages' => [
				[
					'role' => 'user',
					'content' => [
						[
							'type' => 'text',
							'text' => "توی این نمودار نقطه اخرین حمایت و مقاومت نمودار کجا میشه؟ و اینکه ایا روندش صعودیه یا نزولی ؟‌ و چه پوزیشنی بگیرم؟ اگه میشه این هارو تیتر وار بهم بگو"
						],
						[
							'type' => 'image_url',
							'image_url' => ['url' => 'https://amiralinasrollahi.ir/assets/bitcoin.png']
						]
					]

				]
			]
		]), GPT_URL,  "Authorization: " . GPT_TOKEN);

		return $response;
	}
}
