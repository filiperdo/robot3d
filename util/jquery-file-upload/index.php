<?php
session_start();
/*
 * jQuery File Upload Plugin PHP Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

$options = array(
	'upload_dir'  => '../../img/perfil/'. $_SESSION['pic_id_user'] .'/',
	'upload_url'  => '../img/perfil/'. $_SESSION['pic_id_user'] .'/'
);

error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');
$upload_handler = new UploadHandler($options);
