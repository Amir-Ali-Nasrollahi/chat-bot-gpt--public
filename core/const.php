<?php

define("TOKEN", "bot6197638290:AAEnHr_MsRlQbDD7lq0KanSqyzQ5sBEhGi4");
// define("TOKEN", "bot7756905777:AAFMo-Mk1vvoZh1ehQgucosgwMNUQhiFvYY");

$url = "https://api.telegram.org/" . TOKEN . "/";
define("TEL_URL", $url);

define("FILE_URL", "https://api.telegram.org/file/" . TOKEN . "/");

define("URL","https://test.amiralinasrollahi.ir/");
define("TELEGRAM_URL", $url ."/sendMessage");




$gpt_token = "Bearer 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";


$gemini_token = "AIzaSyD5mZVZhVe8tJug8mx56EMR_G0rpJWFH4k";

define("GPT_TOKEN", $gpt_token);
define("GPT_URL", "https://api.openai.com/v1/chat/completions");



define("GEMINI_TOKEN", $gemini_token);
define("GEMINI_URL", "https://api.gemini.com/analyze_image");