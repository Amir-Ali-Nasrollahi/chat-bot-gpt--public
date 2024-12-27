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
	public function check_validity(string $request_method): string
	{
		if (preg_match("/(\/[A-Za-z]+)/", $request_method) && method_exists(new Main_Controller, substr($request_method, 1))) {
			$request_method = substr($request_method, 1);
			return $request_method;
		}
		return "undefind";
	}
}
