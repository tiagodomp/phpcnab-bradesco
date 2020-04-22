<?php


namespace Phpcnab\Bradesco\Layout\RemessaRateioCreditoTipoTres;

use Phpcnab\Bradesco\File\ReadFileBase;
use Phpcnab\Bradesco\Layout\LayoutInterface;
use Phpcnab\Bradesco\Layout\LayoutBase;

class LayoutRateioCreditoTipoTres implements LayoutInterface
{
    use ValidatorRateioCreditoTipoTres;


    public $TipoRegistro = 'Rateio Crédito';

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

    public $espacoBranco1           = [101,108,'1º Espaço em branco', 8, 'blank'];

    public $idSistema               = [109,110, 'Identificação do Sistema', 2, 'text'];

    public $numSequencialRemessa    = [111,117,'Número Sequencial de Remessa', 7, 'number'];

    public $espacoBranco2           = [118,394,'2º Espaço em Branco', 277, 'blank'];

    public $numSequencialRegistro   = [395,400,'Número Sequencial do Registro de Um em Um', 1, 'number'];

    public function __construct(ReadFileBase $linha)
    {
        foreach(get_object_vars($this) as $propiedade => $parametros){
            if($propiedade == 'TipoRegistro')
                continue;

            $layoutBase             = new LayoutBase($propiedade, $parametros);
            $newPropiedade          = $layoutBase->setParametros($linha);
            $newPropiedade          = $this->validateDefault($newPropiedade, $linha->numSequencialRegistro);
            $newPropiedade          = $this->transformValue($newPropiedade, $linha->numSequencialRegistro);
            $propiedadeValidation   = $propiedade.'Validation';
            $this->$propiedade      = (method_exists($this, $propiedadeValidation)) //Esta na Trait
                                        ?$this->$propiedadeValidation($newPropiedade, $linha->getNumLinhaRegistro())
                                        :$newPropiedade;
        }
    }

    /**
     * @interface LayoutInterface
     * @return LayoutRateioCreditoTipoTres
     */
    public function get()
    {
        return $this;
    }

    /**
     * @interface LayoutInterface
     * @return array
     */
    public function getArray()
    {
        return get_object_vars($this);
    }

    /**
     * @interface LayoutInterface
     * @return int
     */
    public function getNumSequencialRegistro()
    {
        return ($this->numSequencialRegistro instanceof LayoutBase)
            ?$this->numSequencialRegistro->get()
            :null;
    }

    /**
     * @interface LayoutInterface
     * @return integer
     */
    public function getIdRegistro()
    {
        return ($this->idRegistro instanceof LayoutBase)
            ?$this->idRegistro->get()
            :null;
    }

    /**
     * @interface LayoutInterface
     * @return string
     */
    public function getTipoRegistro()
    {
        return $this->TipoRegistro;
    }

    /**
     * @interface LayoutInterface
     * @return bool
     */
    public function isValid()
    {
        $validate = [];
        $propiedades = get_object_vars($this);
        unset($propiedades['TipoRegistro']);
        foreach($propiedades as $propiedade => $parametros)
            $validate[] = $parametros instanceof LayoutBase;

        return !empty($validate) && !in_array(false, $validate);
    }
}