<?php


namespace Controller;
use Core\Controller;

class Main_Controller extends Controller
{
	
	private int $chat_id;
	private array $button = [['analysis'],["about me", "donate"]];
	private string $text;


	public function start(array $request) {

		$this->chat_id = $request['message']['chat']['id'];

		$this->text = "hi, how can I help you ?";

		$this->sendMessage($this->chat_id, $this->text, $this->button);

	}


	public function undefind(array $request){
		$this->chat_id = $request['message']['chat']['id'];

		$this->sendMessage($this->chat_id,"tell me a valid command",$this->button );
	}


}
