<?php


namespace Phpcnab\Bradesco\File;

use Phpcnab\Bradesco\File\ReadFileValidator;

class ReadFileBase
{
    use ReadFileValidator;

    public $idRegistro;

    public $numSequencialRegistro;

    public $arrayLinha;

    public $stringLinha;

    public $tipoCnab;

    public $tipoCnabExtension;

    public function __construct($idRegistro, $numSequencialRegistro, $linha){
        $this->idRegistro               = (int) $idRegistro;
        $this->numSequencialRegistro    = (int) $numSequencialRegistro;
        $this->arrayLinha               = (array) $this->getArrayLinha($linha);
        $this->stringLinha              = (string) $linha;
        $this->tipoCnab                 = (int) $this->getTipoCnab($linha);
        $this->tipoCnabExtension        = (string) $this->getTipoCnabExtension($idRegistro);
    }

    public function get()
    {
        return $this;
    }

    public function getArray()
    {
        return $this->arrayLinha;
    }

    public function getString()
    {
        return $this->stringLinha;
    }

    public function getNumLinhaRegistro()
    {
        return $this->numSequencialRegistro;
    }

}