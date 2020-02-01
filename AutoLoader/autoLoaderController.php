<?php
/*
 * AutoLoader es una funcion que se ejecuta automaticamente cuando intentamos utilizar
 * una clase que NO se encuentra en el mismo fichero desde donde se quiere utilizar,
 * esta funcion toma como parametro el nombre de la clase que se intenta instanciar.
 */

if (!function_exists('autoLoaderC')) {

    function autoLoaderC($class) {
        $controllerPath = SITE_ROOT."\\Controlador";
        $classFile = $class . '.php';
        $fullPath = $controllerPath . "\\" . $classFile;
        $clasWasFound = false;

        //  buscamos la clase en el directorio actual
        if (is_file($fullPath)) {
            require_once($fullPath);
            $clasWasFound = true;
        }
        
        // si no está, identificamos los directorios hijos para buscar entre ellos        
        if (!$clasWasFound) {
            
            // listamos los directorios que estan dentro del directorio actual
            $scanCurrentDirList = array_slice(scandir($controllerPath), 2); 
            foreach ($scanCurrentDirList as $dir) {
                $dir = $controllerPath."\\".$dir;
                
                if (is_dir($dir)) {                    
                    $fullPath = $dir."\\".$classFile;                    
                    if (is_file($fullPath)) {
                        require_once($fullPath);
                        $clasWasFound = true;
                        break;
                    }
                }
            }
            
        }
    }

}
spl_autoload_register('autoLoaderC');
