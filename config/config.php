<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/20/17
 * Time: 9:21 PM
 */
define(('ROOT'),dirname(dirname(__FILE__)));
define('DS',DIRECTORY_SEPARATOR);
define('DEVELOPMENT_ENVIRONMENT', true);
if(DEVELOPMENT_ENVIRONMENT==true){
    error_reporting(E_ALL);
    ini_set('display_errors','On');
}
else
{
    error_reporting(E_ALL);
    ini_set('display_errors','Off');

}
define('BASE_URL','http://'.$_SERVER['HTTP_HOST'].'/GitHub/');
define('LIB_PATH',ROOT.DS.'library'.DS);

function __autoload($class_name){
    $class_path= LIB_PATH.DS.'classes'.DS;
    $exp=explode('\\',$class_name);
    foreach ($exp as $key => $value){
        $class_path.=$key==count($exp)-1 ? $value.'.inc.php': $value.DS;
    }
    if(file_exists($class_path))
        require_once ($class_path);
    else
        echo"Class does not exists:$class_path";
}