<?php


namespace Controller;

use Core\Controller;

class Main_Controller extends Controller
{

	private int $chat_id;
	private array $button = [['analysis'], ["about me", "donate"]];
	private string $text = "";


	public function start(array $request)
	{

		$this->chat_id = $request['message']['chat']['id'];

		$this->text = "سلام ، چطور میتونم کمکت کنم ؟‌؟";

		$this->sendMessage($this->chat_id, $this->text, $this->button);
	}

	public function analysis(array $request)
	{

		$this->button = [['Gemini', 'GPT'], ['back']];
	
		$this->chat_id = $request['message']['chat']['id'];

		$this->text = "یکی از گزینه های زیر را انتخاب کنید";

		$this->sendMessage($this->chat_id, $this->text, $this->button);
	
	}

	public function GPT(array $request)
	{
		$this->chat_id = $request["message"]["chat"]['id'];

		$this->text = "لطفا چارتی که میخوای تحلیل کنی رو برام بفرس و پایینش /gpt بنویس";

		$this->button = [['Back']];

		$this->sendMessage($this->chat_id, $this->text, $this->button);
	}

	public function Gemini(array $request)
	{
		$this->chat_id = $request["message"]["chat"]['id'];

		$this->text = "لطفا چارتی که میخوای تحلیل کنی رو برام بفرس و پایینش /gemini بنویس";

		$this->button = [['Back']];

		$this->sendMessage($this->chat_id, $this->text, $this->button);
	}


	public function Back(array $request)
	{
		$this->chat_id = $request['message']['chat']['id'];

		$this->text = "یکی از گزینه های زیر را انتخاب نمایید";

		$this->sendMessage($this->chat_id, $this->text, $this->button);
	}


	public function undefind(array $request)
	{
		$this->chat_id = $request['message']['chat']['id'];

		$this->sendMessage($this->chat_id, "tell me a valid command", $this->button);
	}
}
