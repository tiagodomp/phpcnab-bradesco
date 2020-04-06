<?php


namespace Phpcnab\Bradesco\File;

use Phpcnab\Bradesco\File\ReadFileValidator;

class ReadFileBase
{
    use ReadFileValidator;

    public $idRegistro;

    public $numSequencialRegistro;

    public $arrayLinha;

    public $tipoCnab;

    public $tipoCnabExtension;

    public function __construct($idRegistro, $numSequencialRegistro, $linha){
        $this->idRegistro               = (int) $idRegistro;
        $this->numSequencialRegistro    = (int) $numSequencialRegistro;
        $this->arrayLinha               = (array) $this->getArrayLinha($linha);
        $this->tipoCnab                 = (int) $this->getTipoCnab($this->linha);
        $this->tipoCnabExtension        = (string) $this->getTipoCnabExtension($idRegistro);
    }

}