<?php

/*
 * This file is part of the Phpcnab/Bradesco package.
 *
 * (c) Tiago Pereira <tiagodominguespereira@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Phpcnab\Bradesco\File;

/**
 * Trait ReadFileValidator
 * @package Phpcnab\Bradesco\File
 * @copyright (c) 2020, Tiago Pereira
 * @package Phpcnab/Bradesco
 * @subpackage File
 * @author Tiago Pereira <tiagodominguespereira@gmail.com>
 */
trait ReadFileValidator
{
    /**
     * Get an array of line
     * @param $linha
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage File
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return array
     */
    public function getArrayLinha($linha)
    {
        $search = [';', ':']; //caso seja csv
        return str_split(str_replace($search, '', $linha));
    }

    /**
     * Get the type CNAB
     * @param $linha
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage File
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return int
     */
    public function getTipoCnab($linha)
    {
        if(is_string($linha))
            return strlen($linha) > 404?440:400;

        if(is_array($linha))
            return count($linha) > 404?440:400;
    }

    /**
     * Get the full name by type
     * @param integer $idRegistro
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage File
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return string
     */
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

    /**
     * @param $msg
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage File
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @param $code
     */
    public function infoLog($msg, $code){

    }

    /**
     * @param $msg
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage File
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @param $code
     */
    public function errorLog($msg, $code){

    }
}