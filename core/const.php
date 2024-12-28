<?php

define("TOKEN", "bot6197638290:AAEnHr_MsRlQbDD7lq0KanSqyzQ5sBEhGi4");
// define("TOKEN", "bot7756905777:AAFMo-Mk1vvoZh1ehQgucosgwMNUQhiFvYY");

$url = "https://api.telegram.org/" . TOKEN ;
define("TEL_URL", $url);

define("URL","https://test.amiralinasrollahi.ir/");
define("TELEGRAM_URL", $url ."/sendMessage");
define("IMAGE_URL", $url ."/getFile?file_id=");



$gpt_token = "Bearer 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";

define("GPT_TOKEN", $gpt_token);
define("GPT_URL", "https://api.openai.com/v1/chat/completions");