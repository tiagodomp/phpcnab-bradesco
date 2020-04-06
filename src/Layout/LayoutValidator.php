<?php


namespace Phpcnab\Bradesco\Layout;


trait LayoutValidator
{
    public function getDadoLinhaCnab($parametros, $linhaCnab){

    }

    public function is_number($parametros){
        return $parametros->tipoCampo == 'number';
    }

    public function is_text($parametros){
        return $parametros->tipoCampo == 'text';
    }

    public function is_null($parametros){
        return $parametros->tipoCampo == 'null';
    }


}