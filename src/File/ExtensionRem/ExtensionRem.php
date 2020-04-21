<?php

/*
 * This file is part of the Phpcnab/Bradesco package.
 *
 * (c) Tiago Pereira <tiagodominguespereira@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Phpcnab\Bradesco\File\ExtensionRem;


use Phpcnab\Bradesco\File\ReadFileBase;
use Phpcnab\Bradesco\File\ReadFileInterface;

/**
 * Class ExtensionRem
 * @package Phpcnab\Bradesco\File\ExtensionRem
 * @copyright (c) 2020, Tiago Pereira
 * @package Phpcnab/Bradesco
 * @subpackage File
 * @author Tiago Pereira <tiagodominguespereira@gmail.com>
 */
class ExtensionRem implements ReadFileInterface
{
    public $totalLinhas;

    public $linhasCNAB;

    /**
     * ExtensionRem constructor.
     * @param $nomeArquivo
     * @param $arrayArquivo
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage File
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     */
    public function __construct($nomeArquivo, $arrayArquivo){
        $this->totalLinhas = count($arrayArquivo);

        foreach($arrayArquivo as $num => $linha){
            if(empty($linha) || !is_string($linha))
                continue;

            $idRegistro     = (int) $linha[0];
            $numSqRegistro  = (int) substr($linha, -5);
            $this->linhasCNAB[$nomeArquivo][$numSqRegistro] = new ReadFileBase($idRegistro, $numSqRegistro, $linha);
        }
    }

    /**
     * @interface ReadFileInterface
     * @return array
     */
    public function getFiles(){
        return (array) array_keys($this->linhasCNAB);
    }

    /**
     * @interface ReadFileInterface
     * @return array
     */
    public function getLinha($nomeArquivo, $numSqRegistro){
        return (array) $this->linhasCNAB[$nomeArquivo][$numSqRegistro]?:[];
    }

    /**
     * @interface ReadFileInterface
     * @return array
     */
    public function getArrayFile(){
        return (array) $this->linhasCNAB;
    }

    /**
     * @interface ReadFileInterface
     * @return integer
     */
    public function lineCount(){
        return (int) $this->totalLinhas;
    }
}