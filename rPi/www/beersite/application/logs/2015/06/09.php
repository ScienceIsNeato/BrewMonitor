<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2015-06-09 00:03:06 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected '->' (T_OBJECT_OPERATOR) ~ APPPATH/classes/Controller/Welcome.php [ 18 ] in file:line
2015-06-09 00:03:06 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-06-09 00:10:02 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected '$data' (T_VARIABLE) ~ APPPATH/classes/Controller/Welcome.php [ 19 ] in file:line
2015-06-09 00:10:02 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-06-09 00:27:15 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected '$data' (T_VARIABLE) ~ APPPATH/classes/Controller/Welcome.php [ 19 ] in file:line
2015-06-09 00:27:15 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-06-09 00:28:52 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected '$data' (T_VARIABLE) ~ APPPATH/classes/Controller/Welcome.php [ 19 ] in file:line
2015-06-09 00:28:52 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-06-09 00:29:04 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected '$data' (T_VARIABLE) ~ APPPATH/classes/Controller/Welcome.php [ 19 ] in file:line
2015-06-09 00:29:04 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-06-09 00:29:23 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected '$data' (T_VARIABLE) ~ APPPATH/classes/Controller/Welcome.php [ 19 ] in file:line
2015-06-09 00:29:23 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-06-09 00:29:36 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected '$data' (T_VARIABLE) ~ APPPATH/classes/Controller/Welcome.php [ 19 ] in file:line
2015-06-09 00:29:36 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-06-09 00:29:43 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected '$data' (T_VARIABLE) ~ APPPATH/classes/Controller/Welcome.php [ 19 ] in file:line
2015-06-09 00:29:43 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-06-09 00:30:08 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected '$data' (T_VARIABLE) ~ APPPATH/classes/Controller/Welcome.php [ 19 ] in file:line
2015-06-09 00:30:08 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-06-09 00:37:29 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected '$data' (T_VARIABLE) ~ APPPATH/classes/Controller/Welcome.php [ 19 ] in file:line
2015-06-09 00:37:29 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-06-09 00:38:16 --- EMERGENCY: View_Exception [ 0 ]: The requested view status could not be found ~ SYSPATH/classes/Kohana/View.php [ 265 ] in /var/www/beersite/system/classes/Kohana/View.php:145
2015-06-09 00:38:16 --- DEBUG: #0 /var/www/beersite/system/classes/Kohana/View.php(145): Kohana_View->set_filename('status')
#1 /var/www/beersite/system/classes/Kohana/View.php(30): Kohana_View->__construct('status', NULL)
#2 /var/www/beersite/application/classes/Controller/Welcome.php(17): Kohana_View::factory('status')
#3 /var/www/beersite/system/classes/Kohana/Controller.php(84): Controller_Welcome->action_status()
#4 [internal function]: Kohana_Controller->execute()
#5 /var/www/beersite/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Welcome))
#6 /var/www/beersite/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /var/www/beersite/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/beersite/index.php(118): Kohana_Request->execute()
#9 {main} in /var/www/beersite/system/classes/Kohana/View.php:145
2015-06-09 00:39:36 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected ':' ~ APPPATH/classes/Model/data.php [ 10 ] in file:line
2015-06-09 00:39:36 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-06-09 00:40:13 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected ')', expecting ';' ~ APPPATH/classes/Model/data.php [ 13 ] in file:line
2015-06-09 00:40:13 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-06-09 00:41:29 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected 'return' (T_RETURN), expecting ';' ~ APPPATH/classes/Model/data.php [ 16 ] in file:line
2015-06-09 00:41:29 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-06-09 00:42:22 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected '""' (T_CONSTANT_ENCAPSED_STRING), expecting ',' or ';' ~ APPPATH/views/status.php [ 17 ] in file:line
2015-06-09 00:42:22 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-06-09 00:46:38 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected '$pressure' (T_VARIABLE), expecting ',' or ';' ~ APPPATH/views/status.php [ 16 ] in file:line
2015-06-09 00:46:38 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-06-09 00:51:46 --- EMERGENCY: ErrorException [ 8 ]: Array to string conversion ~ APPPATH/classes/Model/data.php [ 10 ] in /var/www/beersite/application/classes/Model/data.php:10
2015-06-09 00:51:46 --- DEBUG: #0 /var/www/beersite/application/classes/Model/data.php(10): Kohana_Core::error_handler(8, 'Array to string...', '/var/www/beersi...', 10, Array)
#1 /var/www/beersite/application/classes/Controller/Welcome.php(18): Model_data->get_current_tp()
#2 /var/www/beersite/system/classes/Kohana/Controller.php(84): Controller_Welcome->action_status()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/beersite/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Welcome))
#5 /var/www/beersite/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/beersite/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/beersite/index.php(118): Kohana_Request->execute()
#8 {main} in /var/www/beersite/application/classes/Model/data.php:10
2015-06-09 00:52:31 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected '$tp' (T_VARIABLE) ~ APPPATH/classes/Model/data.php [ 10 ] in file:line
2015-06-09 00:52:31 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line