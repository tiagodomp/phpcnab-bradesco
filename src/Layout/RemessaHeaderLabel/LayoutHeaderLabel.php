<?php


namespace Phpcnab\Bradesco\Layout\RemessaHeaderLabel;

use Phpcnab\Bradesco\Layout\LayoutInterface;
use Phpcnab\Bradesco\Layout\LayoutBase;

class LayoutHeaderLabel implements LayoutInterface
{
    public $TipoRegistro = 'Header Label';

    //alias campo tabela          posicao De/a      Nome do Campo  Tam. Campo   Tipo
    public $idRegistro              = [1,1,'Identificação do Registro', 1, 'number'];

    public $idArquivoRemessa        = [2,2,'Identificação do Arquivo Remessa ', 2, 'number'];

    public $literalRemessa          = [3,9,'Literal Remessa', 7, 'text'];

    public $codigoServico           = [10,11,'Código de Serviço', 2, 'number'];

    public $literalServico          = [12,26,'Literal Serviço', 15, 'text'];

    public $codigoEmpresa           = [27,46,'Código da Empresa', 20, 'number'];

    public $nomeEmpresa             = [47,76,'Nome da Empresa', 30, 'text'];

    public $numBradesco             = [77,79,'Número do Bradesco na Câmara de Compensação', 3, 'number'];

    public $nomeBanco               = [80,94,'Nome do Banco por Extenso', 15, 'text'];

    public $dataGravacao            = [95,100,'Data da Gravação do Arquivo', 6, 'number'];

    public $espacoBranco1           = [101,108,'1º Espaço em branco', 8, 'null'];

    public $idSistema               = [109,110, 'Identificação do Sistema', 2, 'text'];

    public $numSequencialRemessa    = [111,117,'Número Sequencial de Remessa', 7, 'number'];

    public $espacoBranco2           = [118,394,'2º Espaço em Branco', 277, 'null'];

    public $numSequencialRegistro   = [395,400,'Número Sequencial do Registro de Um em Um', 6, 'number'];

    public function __construct($linhaCNAB){
        foreach(get_object_vars($this) as $propiedade => $parametros){
            $layoutBase = new LayoutBase($propiedade, $parametros);
            $layoutBase->unsetParametros();
            $this->$propiedade = $layoutBase->setParametros($linhaCNAB);
        }
    }

    public function getLinha(){
        return $this;
    }

    public function getNumSequencialRegistro(){
        return $this->numSequencialRegistro;
    }

    public function getIdRegistro(){
        return $this->idRegistro;
    }

    public function getTipoRegistro(){
        return $this->TipoRegistro;
    }
}