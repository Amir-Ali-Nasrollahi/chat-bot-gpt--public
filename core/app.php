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



		if($value['message']['text'] == "/start")
			include_once("./controller/Main_Controller.php");
		
		
		$this->method = $this->check_validity($value['message']['text']);
		

		call_user_func_array([new Main_Controller(), $this->method], [$value]);
	}


	public function check_validity(string $request_method)
	{

		$file = fopen("./app.json", "r");

		$read = fread($file, filesize("./app.json"));

		fclose($file);

        $read = json_decode($read, 1)['command_list'];
		
		$is_key_exist = key_exists($request_method, $read);
	
		if($is_key_exist)
			$request_method = $read[$request_method];



		$is_request_valid = preg_match("/(\/[A-Za-z]+)/", $request_method) ? true : false;
		
		
		$request_method = str_replace(' ','', $request_method);
		$is_method_exist = method_exists(new Main_Controller, substr($request_method, 1));

		if ($is_request_valid && $is_method_exist) {
			$request_method = substr($request_method, 1);
			return $request_method;
		}
		return "undefind";
	}
}
