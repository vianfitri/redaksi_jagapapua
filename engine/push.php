<?php
exit();
// Parameter
$title       = @$_GET['title'];
$body        = @$_GET['body'];
$type        = @$_GET['type'];
$id          = @$_GET['id'];
$to_android  = "/topics/all";
// Android Deni
// $to_android  = "f-PTjD5jaGg:APA91bF9hISjgEjcKligqHG9M3ZLdWC4Zc-Z3RXGglq_vwd3uCKf8A47X4ZPmVa701fU9yNxtB1cGfwUv6N1g9l5feYTgQvmdpv08mlLj-t4OEEoEHLzDDZEoEJqcrCMeYYrBv5diPc6";
// Android Irul
// $to_android  = "e2CzveBdqLQ:APA91bG9wr3aR9xggsUFkCK1yOG0aLVVl81QaUIWh4TcCuVGlDXpzACv-eGF3xL-UoVXRV4KtlcvoflVmbQL04uv1bBbWYIN6pVsHBVOhNsQneDhXMZeNft5nx1ALiQq54ONiud7bwhY";
$to_ios      = "/topics/all";
// $to_ios      = "fqsa1PCQNRc:APA91bGfmebDbxLCeDaLHMIy8ndgE0GU4b75PgQjBOAn2ZETjwrUgVz51N4or24e1Ga-QZKCjIwaaUZhcIMN0ilL6DxWxslhjD-hG13OK0RamStQZ9fZrqWkUUJJV6ZI-YbuxSMwMyIx";
// Data
$data        = array(
	"notification" => array(
		"title" => urldecode($title),
		"body" => urldecode($body),
		"sound" => "default",
		"click_action" => "FCM_PLUGIN_ACTIVITY",
		"icon" => "icon"
	),
	"data" => array(
		"type" => $type,
		"id" => $id
	),
	"to" => $to_android,
	"priority" => "high"
);
$data_string = json_encode($data);

// Android
$ch_an = curl_init('https://fcm.googleapis.com/fcm/send');
curl_setopt($ch_an, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch_an, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch_an, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_an, CURLOPT_HTTPHEADER, array(
	'Authorization: key=AAAABBfim68:APA91bHnTVeP8WNZ8dT_0x5uRj5YaVwMrMrNBQEh5k9BVp_kG4BuodqcS5hzOdOoLUjI3u9Ncij7HRKuApL0pF8Ca79EjvnosgdaFLF5hMj6efL0gwyaAwaJKJB-ieXH26J5vZ_wnHuO',
	'Content-Type: application/json'
));
$result_an = curl_exec($ch_an);
echo 'All Result<br>';
print_r($result_an);

// Bagian ini di komen karena bagian atas telah mengirim ke semua device IOS maupun android
/* 
$ch           = curl_init("https://fcm.googleapis.com/fcm/send");
$notification = array(
	'title' => urldecode($title),
	'text' => urldecode($body)
);
$data         = array(
	"type" => $type,
	"id" => $id
);
$arrayToSend  = array(
	'to' => $to_ios,
	'notification' => $notification,
	'priority' => 'high',
	'data' => $data
);
$json         = json_encode($arrayToSend);
$headers      = array();
$headers[]    = 'Content-Type: application/json';
$headers[]    = 'Authorization: key=AIzaSyClbaGu-uS9eYtYaZkjLUXagTYDL6xKCys';
echo '<br>IOS Result<br>';
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch); 
*/