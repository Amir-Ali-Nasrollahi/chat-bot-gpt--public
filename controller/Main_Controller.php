<?php


namespace Controller;

use Core\Controller;

class Main_Controller extends Controller
{

	private $chat_id;
	private $button = [["about me", "donate"]];
	private $text = "";


	public function start(array $request)
	{

		$this->chat_id = $request['message']['chat']['id'];

		// $this->text = "سلام ، چطور میتونم کمکت کنم ؟‌؟";
		// if($request['message'])

		$this->sendMessage($this->chat_id, json_encode($request), $this->button);
	}


	public function GPT_image(array $request)
	{
		// get and set chat id to send new message 
		$this->chat_id = $request["message"]["chat"]['id'];

		// get photo 
		$photo_id = $request['message']['photo'][0]['file_id'];
		$file_url = TEL_URL . "getFile?file_id=" . $photo_id;
		$response = json_decode(file_get_contents($file_url), true);
		$file_path = $response['result']['file_path'];

		// send photo with caption to chat gpt
		$res = $this->useGPT("https://api.telegram.org/file/".TOKEN."/" . $file_path, $request['message']['caption']);
		
		// get message of gpt and send it to user who run the bot
		$this->text = json_decode($res, true)['choices'][0]['message']['content'];


		$this->sendMessage($this->chat_id, $this->text, $this->button);
	}

	public function GPT_text(array $request)
	{
		$this->chat_id = $request['message']['chat']['id'];

		$res = $this->useGPT(text:$request['message']['text']);
		$this->text = $res['choices'][0]['message']['content'];
		$this->sendMessage($this->chat_id, $this->text, $this->button);

	}

	public function undefind(array $request)
	{
		$this->chat_id = $request['message']['chat']['id'];

		$this->sendMessage($this->chat_id, "لطفا یه دستور معتبر بهم بدید", $this->button);
	}

	public function about_me(array $request) {
	
		$this->chat_id = $request['message']['chat']['id'];

		$this->text = "امیرعلی ام‌:)
		این رباتم ساختم که همینطوری ساخته باشم
		اگه مشکلی چیزی داشت یا موردی بود به این ایدی پیام بده @tarbz2
		اگه هم دوست داشتی به توسعه اش کمک کنی (که خیلی خوشحال میشم) خیلی راحت به گیتهابم سر بزن
		
		ادرس گیتهابم ؟ از توی سایتم برش دار🙃🙃
		amiralinasrollahi.ir

		خوشحال میشم اگه برنامه نویسی تو توسعه نرم افزار های ازاد با هم دیگه 🐧🐧کار کنیم
		";

		$this->button = [['برگشتن']];
		$this->sendMessage($this->chat_id, "لطفا یه دستور معتبر بهم بدید", $this->button);
		
	}

	public function donate(array $request) {
	
		$this->chat_id = $request['message']['chat']['id'];

		$this->text = "❤️❤️ همینکه روی این گزینه زدی واسه من کافیه عزیز دل
		
		فعلا نیازی نیست
		
		اگه برنامه نویسی خیلی خوشحال میشم تو توسعه اش کمکم کنی اگر هم نیستی که بهتر
		😊😊 فقط ازش استفاده کن";

		$this->button = [['برگشتن']];
		$this->sendMessage($this->chat_id, "لطفا یه دستور معتبر بهم بدید", $this->button);
			
	}
}
