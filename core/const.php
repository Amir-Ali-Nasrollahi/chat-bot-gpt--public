<?php

define("TOKEN", "YOUR TELEGRAM API TOKEN");

$url = "https://api.telegram.org/" . TOKEN . "/";
define("TEL_URL", $url);

define("FILE_URL", "https://api.telegram.org/file/" . TOKEN . "/");

define("URL","https://test.amiralinasrollahi.ir/");
define("TELEGRAM_URL", $url ."sendMessage");




$gpt_token = "Bearer YOUR GPT TOKEN";
define("GPT_TOKEN", $gpt_token);
define("GPT_URL", "YOUR GPT URL");
