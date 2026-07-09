<?php

//حقوق @ROIUCX
//حقوق @ROIUCX
$token   = "7022789634:AAHRrjnYG65CmuOJR61Tj7Rl74u1Czdew5Q";  //توكن حب
$api_url = "https://devil.xo.je/v/c/wormgpt.php";
$channel = "@ROIUCX";

//حقوق @ROIUCX
//حقوق @ROIUCX

$update  = json_decode(file_get_contents("php://input"), true);
$message = $update['message'] ?? null;
if (!$message) exit;

$chat_id = $message['chat']['id'];
$text    = $message['text'] ?? '';

//حقوق @ROIUCX
//حقوق @ROIUCX

function send($token, $chat_id, $text, $keyboard = null) {
    $data = ['chat_id' => $chat_id, 'text' => $text];
    if ($keyboard) $data['reply_markup'] = $keyboard;
    $ch = curl_init("https://api.telegram.org/bot$token/sendMessage");
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_POSTFIELDS => $data]);
    curl_exec($ch); curl_close($ch);
}

//حقوق @ROIUCX
//حقوق @ROIUCX

if ($text == '/start') {
    send($token, $chat_id, "أهلاً 👋\nاسألني أي شيء ",
        json_encode(['inline_keyboard' => [[['text' => 'قناة البوت', 'url' => 'https://t.me/ROIUCX']]]]));

} elseif (!empty($text) && !str_starts_with($text, '/')) {
    send($token, $chat_id, "⏳ جاري التفكير...");

//حقوق @ROIUCX
//حقوق @ROIUCX

    $ch = curl_init($api_url . "?prompt=" . urlencode($text));
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_TIMEOUT => 30]);
    $res = json_decode(curl_exec($ch), true);
    curl_close($ch);

    $answer = $res['answer'] ?? null;
    send($token, $chat_id,
        $answer
            ? " $answer\n\nمن قناة: $channel"
            : "❌ فشل، حاول مجدداً\n\nمن قناة: $channel"
    );
}
//حقوق @ROIUCX
//حقوق @ROIUCX