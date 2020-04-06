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
    public $valorCampo;

    protected $sucesso;
    public $msg;

    private $propiedade;
    private $parametros;

    public function __construct($propiedade, $parametros){
        $this->propiedade = $propiedade;
        $this->parametros = $parametros;
    }

    public function setParametros(ReadFileBase $linha)
    {
        if(count($this->parametros) < 5)
            return (object) [];
        $this->posicaoInicio = (int) $this->parametros[0]; //int
        $this->posicaoFinal  = (int)  $this->parametros[1]; //int
        $this->nomeCampo     = (string)  $this->parametros[2]; //string
        $this->tamanhoCampo  = (int)  $this->parametros[3]; //int
        $this->tipoCampo     = $this->parametros[4]; //int ou string
        $this->aliasCampo    = (string) $this->propiedade;    //string
        $this->valorCampo    = $this->valueTipoCampo($linha->arrayLinha);
        return $this;
    }

    private function valueTipoCampo($linhaCNAB){
        if(!is_array($linhaCNAB) || empty($linhaCNAB))
            return [];

        $valor = array_slice($linhaCNAB, $this->posicaoInicio - 1, $this->tamanhoCampo);
    }

    public function unsetParametros()
    {
        $this->posicaoInicio = 0;
        $this->posicaoFinal  = 0;
        $this->nomeCampo     = '';
        $this->tamanhoCampo  = 0;
        $this->tipoCampo     = null;
        $this->aliasCampo    = '';
        $this->valorCampo    = [];
        $this->propiedade    = '';
        $this->parametros    = [];

        return $this;
    }
}