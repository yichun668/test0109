<?php
 $json_str = file_get_contents('php://input'); //接收REQUEST的BODY
 $json_obj = json_decode($json_str); //轉JSON格式

 //產生回傳給line server的格式aaa
 $sender_userid = $json_obj->events[0]->source->userId;
 $sender_txt = $json_obj->events[0]->message->text;
 $sender_replyToken = $json_obj->events[0]->replyToken;
 $line_server_url = 'https://api.line.me/v2/bot/message/push';
 //用sender_txt來分辨要發何種訊息
 $objID = $json_obj->events[0]->message->id;
			$url = 'https://api.line.me/v2/bot/message/'.$objID.'/content';
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Authorization: Bearer 9knlJRZBbsuxmgFxx0cpBMCTp8AmWS2eaXaO81WxBTUE0Z74Sjnq6lJXd+g86BP7w4Pe+aH/O4eiZcfgOMQuAISQX+FOgxDNHgyxxX8GTgTfqOW+v2/HA5qJ1YFusjV8OhsHuskj4mgIgZX1Eotv0QdB04t89/1O/w1cDnyilFU=";
				//n4mZIQp9UqWXhCEgIg1fLmyjUeDMgCe/bF+4EOBDZ7fGscOgNGFsHTr3fGco/E7A5hq7A7jiDszSCk/j3pVVPbx7nf0E+FKe5jX6syQGOxO7kwp5lmZ3zRES1qxceq/N+/E9Qy5gSDbBx56l8sScTwdB04t89/1O/w1cDnyilFU=',
			));
				
			$json_content = curl_exec($ch);
			curl_close($ch);
 $imagefile = fopen($objID.".jpeg", "w+") or die("Unable to open file!"); //設定一個log.txt，用來印訊息
			fwrite($imagefile, $json_content); 
			fclose($imagefile);

 //回傳給line server
 $header[] = "Content-Type: application/json";
 $header[] = "Authorization: Bearer 9knlJRZBbsuxmgFxx0cpBMCTp8AmWS2eaXaO81WxBTUE0Z74Sjnq6lJXd+g86BP7w4Pe+aH/O4eiZcfgOMQuAISQX+FOgxDNHgyxxX8GTgTfqOW+v2/HA5qJ1YFusjV8OhsHuskj4mgIgZX1Eotv0QdB04t89/1O/w1cDnyilFU=";
// n4mZIQp9UqWXhCEgIg1fLmyjUeDMgCe/bF+4EOBDZ7fGscOgNGFsHTr3fGco/E7A5hq7A7jiDszSCk/j3pVVPbx7nf0E+FKe5jX6syQGOxO7kwp5lmZ3zRES1qxceq/N+/E9Qy5gSDbBx56l8sScTwdB04t89/1O/w1cDnyilFU=";
 $ch = curl_init("https://api.line.me/v2/bot/message/reply");                                                                      
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
 curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));                                                                  
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
 curl_setopt($ch, CURLOPT_HTTPHEADER, $header);                                                                                                   
 $result = curl_exec($ch);
 curl_close($ch); 

?>
