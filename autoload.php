<?php 
function autoload($classPath){
    $filePath = str_replace('\\', '/', $classPath . '.php');
    include_once ($filePath);
}
spl_autoload_register('autoload');

?>
