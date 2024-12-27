<?php


namespace Controller;
use Core\Controller;

class Main_Controller extends Controller{
	
	private int $chat_id;
	private array $value;


	public function start($request) {
		$this->value = [
			['just watching'],["long position", "short position"]
		];
		$this->chat_id = $request['message']['chat']['id'];
		$this->sendMessage($this->chat_id, "دلقک شدی بات رو ران کردی",$this->value );

	}
	public function undefind($request){
		$this->value = [
			['first_button'],["second_button", "thirth_button"]
		];
		$this->chat_id = $request['message']['chat']['id'];
		$this->sendMessage($this->chat_id,"tell me a valid command",$this->value );
	}


}
