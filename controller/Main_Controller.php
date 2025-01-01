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

		$this->button = [['back']];
	
		$this->chat_id = $request['message']['chat']['id'];

		$this->text = "
			راهنما :‌
			واسه اینکه نمودارتو gemini یا gpt میخوای تحلیل کنه 
			باید پایین عکسی که میخوای بفرسی فقط فقط /gemini یا /gpt مینویسی
			بعدم واست تحلیلشو میفرسته :)

			میتونی دوتاشو باهم بزاری تا از طرف ربات یه دوتا فوش اب دار بخوری‌ 🙃🙃
		";

		$this->sendMessage($this->chat_id, $this->text, $this->button);
	
	}

	public function GPT(array $request)
	{
		$this->chat_id = $request["message"]["chat"]['id'];

		$photo_id = $request['message']['photo']['file_id'];
		
		$file_url = IMAGE_URL . $photo_id;

		$response = json_decode(file_get_contents($file_url), true);

		$file_path = $response['result']['file_path'];


		// $photo_url =;
		$file_name = time() . 'amirali.jpg';
		file_put_contents(URL. "public/".$file_name,file_get_contents( TEL_URL . $file_path));

		$res = $this->useGPT(URL."public/" . $file_name);
		
		$this->text = $res;


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

		$this->sendMessage($this->chat_id, "لطفا یه دستور معتبر بهم بدید", $this->button);
	}
}
