<?php


namespace Phpcnab\Bradesco\Layout;

use Phpcnab\Bradesco\Layout\RemessaHeaderLabel\LayoutHeaderLabel;
use Phpcnab\Bradesco\Layout\RemessaHeaderLabel\LayoutMensagemTipoDois;
use Phpcnab\Bradesco\Layout\RemessaHeaderLabel\LayoutRateioCreditoTipoTres;
use Phpcnab\Bradesco\Layout\RemessaHeaderLabel\LayoutTransacaoTipoUm;

class LayoutContext
{
    public $CNAB
    public function __construct($arquivoCNAB)
    {
        foreach($arquivoCNAB as $numLinha => $valueLinha){
            switch($value[0]){
                case 0:
                    $layout = new LayoutHeaderLabel($valueLinha);
                    break;
                case 1:
                    $layout = new LayoutTransacaoTipoUm($valueLinha);
                    break;
                case 2:
                    $layout = new LayoutMensagemTipoDois($valueLinha);
                    break;
                case 3:
                    $layout = new LayoutRateioCreditoTipoTres($valueLinha);
                    break;
            }

            $this->CNAB[$key] = $layout->getLinha();
        }
    }
}