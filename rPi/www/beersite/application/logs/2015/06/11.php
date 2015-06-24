<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2015-06-11 22:40:39 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: submit ~ APPPATH/classes/Controller/Welcome.php [ 25 ] in /var/www/beersite/application/classes/Controller/Welcome.php:25
2015-06-11 22:40:39 --- DEBUG: #0 /var/www/beersite/application/classes/Controller/Welcome.php(25): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/beersi...', 25, Array)
#1 /var/www/beersite/system/classes/Kohana/Controller.php(84): Controller_Welcome->action_authenticate()
#2 [internal function]: Kohana_Controller->execute()
#3 /var/www/beersite/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Welcome))
#4 /var/www/beersite/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /var/www/beersite/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/beersite/index.php(118): Kohana_Request->execute()
#7 {main} in /var/www/beersite/application/classes/Controller/Welcome.php:25