<?php


namespace Phpcnab\Bradesco\Layout;


use Phpcnab\Bradesco\File\ReadFileBase;

class LayoutBase
{
    public $posicaoInicio;
    public $posicaoFinal;
    public $nomeCampo;
    public $tamanhoCampo;
    public $tipoCampo;
    public $aliasCampo;
    public $valorCampoArray;
    public $valorCampo;

    public $status  = true;
    public $msg     = '';

    private $propiedade;
    private $parametros;

    public function __construct($propiedade, $parametros){
        $this->unsetParametros();
        $this->propiedade = $propiedade;
        $this->parametros = $parametros;
    }

    public function setParametros(ReadFileBase $linha)
    {
        if(count($this->parametros) < 5)
            return (object) [];
        $this->posicaoInicio    = (int) $this->parametros[0]; //int
        $this->posicaoFinal     = (int)  $this->parametros[1]; //int
        $this->nomeCampo        = (string)  $this->parametros[2]; //string
        $this->tamanhoCampo     = (int)  $this->parametros[3]; //int
        $this->tipoCampo        = $this->parametros[4]; //string
        $this->aliasCampo       = (string) $this->propiedade;    //string
        $this->valorCampoArray  = $this->getDadoLinhaCnab($linha->arrayLinha);
        $this->valorCampo       = null;
        return $this;
    }

    private function getDadoLinhaCnab($linhaCNAB){
        if(!is_array($linhaCNAB) || empty($linhaCNAB))
            return [];

        return array_slice($linhaCNAB, $this->posicaoInicio - 1, $this->tamanhoCampo);
    }

    public function unsetParametros()
    {
        $this->posicaoInicio = 0;
        $this->posicaoFinal  = 0;
        $this->nomeCampo     = '';
        $this->tamanhoCampo  = 0;
        $this->tipoCampo     = null;
        $this->aliasCampo    = '';
        $this->valorCampoArray    = [];
        $this->propiedade    = '';
        $this->parametros    = [];
        $this->valorCampo    = null;

        return $this;
    }

    public function get()
    {
        return $this->valorCampo;
    }

    public function getArray()
    {
        return $this->valorCampoArray;
    }

    public function getString()
    {
        return implode('', $this->valorCampoArray);
    }

    public function getNome()
    {
        return $this->nomeCampo;
    }
}