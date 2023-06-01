<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2022-11-07 13:27:33 --- EMERGENCY: Kohana_Exception [ 0 ]: Untrusted host www.redaksi.jagapapua.com. If you trust www.redaksi.jagapapua.com, add it to the trusted hosts in the `url` config file. ~ SYSPATH/classes/Kohana/URL.php [ 107 ] in /home/u5629177/public_html/redaksi/system/classes/Kohana/URL.php:144
2022-11-07 13:27:33 --- DEBUG: #0 /home/u5629177/public_html/redaksi/system/classes/Kohana/URL.php(144): Kohana_URL::base('https', true)
#1 /home/u5629177/public_html/redaksi/system/classes/Kohana/HTTP/Exception/Redirect.php(29): Kohana_URL::site('/login', true, true)
#2 /home/u5629177/public_html/redaksi/system/classes/Kohana/HTTP.php(40): Kohana_HTTP_Exception_Redirect->location('/login')
#3 /home/u5629177/public_html/redaksi/system/classes/Kohana/Controller.php(127): Kohana_HTTP::redirect('/login', 302)
#4 /home/u5629177/public_html/redaksi/modules/login/classes/Controller/Login.php(75): Kohana_Controller::redirect('/login')
#5 /home/u5629177/public_html/redaksi/system/classes/Kohana/Controller.php(84): Controller_Login->action_auth()
#6 [internal function]: Kohana_Controller->execute()
#7 /home/u5629177/public_html/redaksi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Login))
#8 /home/u5629177/public_html/redaksi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 /home/u5629177/public_html/redaksi/system/classes/Kohana/Request.php(993): Kohana_Request_Client->execute(Object(Request))
#10 /home/u5629177/public_html/redaksi/index.php(119): Kohana_Request->execute()
#11 {main} in /home/u5629177/public_html/redaksi/system/classes/Kohana/URL.php:144