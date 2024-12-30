<?php


namespace Core;
use Controller\Main_Controller;
final class App
{
	private string $method = "undefind";

	public function __construct()
	{
		$input = file_get_contents("php://input");
		header("Content-type:application/json");
		$value = json_decode($input, true);
		include_once("./controller/Main_Controller.php");


		
		if(isset($value['message']['text']))
			$this->method = $this->check_validity($value['message']['text']);
		
		elseif (isset($value['message']['photo']))
			$this->method = "GPT_image";
		

		call_user_func_array([new Main_Controller(), $this->method], [$value]);
	}


	public function check_validity(string $request_method) : string
	{
		/**
		 * 
		 * here, i know i could write `fopen` insted of `file_get_content` and `fopen` have lower memory usage than this,but i think its simple code and test bot for me which no many people use it 
		 * 
		 */
		$read = file_get_contents('./app.json');
		
		// get exsiting `command list` from `app.json` 
        $read = json_decode($read, 1)['command_list'];
		
		// check is command exist or no
		$is_key_exist = key_exists($request_method, $read);
		if($is_key_exist)
			$request_method = $read[$request_method];


		// check validity of request method ( even get it from app.json )
		$is_request_valid = preg_match("/(\/[A-Za-z]+)/", $request_method) ? true : false;
		
		// check is method of command exist or not
		$is_method_exist = method_exists(new Main_Controller, substr($request_method, 1));

		/**
		 * 
		 * sorry ! i know mabey its hard to read but unlike the previous cases i thought to myself its better
		 * 
		 */
		if ($is_request_valid && $is_method_exist) {
			$request_method = substr($request_method, 1);
			return $request_method;
		}
		elseif($is_request_valid)
			return "undefind";
	
		return "GPT_text";
	}
}
