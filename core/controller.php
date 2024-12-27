<?php

namespace Core;

abstract class Controller
{
	public static function DbConnection($table_name) {
		
		return new (ucfirst($table_name));

	}

	public function connection(array $data): void
	{
		$ch = curl_init(TELEGRAM_URL);
		curl_setopt_array($ch, [
			CURLOPT_POST => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS => $data,
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
				'is_persistent' => true
			])
		]);
	}

}
