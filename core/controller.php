<?php

namespace Core;

abstract class Controller
{

	// public static function DbConnection($table_name)
	// {
	// 	return new (ucfirst($table_name));
	// }
	public function connection($data, string $address)
	{
		$ch = curl_init($address);
		curl_setopt_array($ch, [
			CURLOPT_POST => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS => $data
		]);
		curl_exec($ch);
		curl_close($ch);
	}

	public function sendMessage(int $chat_id, string $text, array $keyboard = []): void
	{
		$this->connection([
			"chat_id" => $chat_id,
			"text" => $text,
			"reply_markup" => json_encode([
				"keyboard" => $keyboard,
				'resize_keyboard' => true,
				'is_persistent' => false
			])
		], TELEGRAM_URL);
	}


	public function connectionForAi($data, string $address, string $auth = "")
	{
		$ch = curl_init($address);
		curl_setopt_array($ch, [
			CURLOPT_POST => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS => $data,
			CURLOPT_HTTPHEADER => ["Content-Type: application/json", $auth],
		]);
		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}

	public function useGPT($url = null, $text)
	{

		/**
		* 
		* i know i could use just `if` insted of `if & else` but i think its  can be better for who want read this code(its easy for reader),
		*
		**/


		if (empty($url))
			$response = $this->connectionForAi(json_encode([
			'model' => 'gpt-4o-mini',
			'store' => true,
			'messages' => [
				[
					'role' => 'user',
					'content' => [
						[
							'type' => 'text',
							'text' => $text
						],
						[
							'type' => 'image_url',
							'image_url' => ['url' => $url]
						]
					]

				]
			]
		]), GPT_URL,  "Authorization: " . GPT_TOKEN);

		else
		$response = $this->connectionForAi(json_encode([
			'model' => 'gpt-4o-mini',
			'store' => true,
			'messages' => [
				[
					'role' => 'user',
					'content' => $text

				]
			]
		]), GPT_URL,  "Authorization: " . GPT_TOKEN);
		
		return $response;
	}

}
