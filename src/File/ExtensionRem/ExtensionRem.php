<?php


namespace Phpcnab\Bradesco\File\ExtensionRem;


use Phpcnab\Bradesco\File\ReadFileBase;
use Phpcnab\Bradesco\File\ReadFileInterface;

class ExtensionRem implements ReadFileInterface
{
    public $totalLinhas;

    public $linhasCNAB;

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

    public function getFiles(){
        return array_keys($this->linhasCNAB);
    }

    public function getLinha($nomeArquivo, $numSqRegistro){
        return $this->linhasCNAB[$nomeArquivo][$numSqRegistro]?:[];
    }

    public function getArrayFile(){
        return $this->linhasCNAB;
    }

    public function countLinhas(){
        return $this->totalLinhas;
    }
}