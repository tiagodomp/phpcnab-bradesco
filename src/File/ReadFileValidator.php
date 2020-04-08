<?php


namespace Phpcnab\Bradesco\File;


trait ReadFileValidator
{
    public function getArrayLinha($linha)
    {
        $search = [';', ':']; //caso seja csv
        return str_split(str_replace($search, '', $linha));
    }

    public function getTipoCnab($linha)
    {
        if(is_string($linha))
            return strlen($linha) > 404?440:400;

        if(is_array($linha))
            return count($linha) > 404?440:400;
    }
    public function getTipoCnabExtension($idRegistro){
        $idRegistro = (int) $idRegistro;
        switch($idRegistro){
            case 0:
                return 'Registro 0 - Header Label';
            case 1:
                return 'Registro 1 - Transação';
            case 2:
                return 'Registro 2 - Mensagem (opcional)';
            case 3:
                return 'Registro 3 - Rateio de Crédito (opcional)';
            case 6:
                return 'Registro 6 - Multiplas transferências';
            case 7:
                return 'Registro 7 - Sacador Avalista';
            case 9:
                return 'Registro 9 - Trailler';
            default:
                return 'Rgistro '.$idRegistro.' - Indefinido';
        }
    }

    public function infoLog($msg, $code){

    }

    public function errorLog($msg, $code){

    }
}