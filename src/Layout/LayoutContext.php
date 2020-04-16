<?php


namespace Phpcnab\Bradesco\Layout;

use Phpcnab\Bradesco\File\ReadFileContext;
use Phpcnab\Bradesco\Layout\RemessaHeaderLabel\LayoutHeaderLabel;
use Phpcnab\Bradesco\Layout\RemessaMensagemTipoDois\LayoutMensagemTipoDois;
use Phpcnab\Bradesco\Layout\RemessaRateioCreditoTipoTres\LayoutRateioCreditoTipoTres;
use Phpcnab\Bradesco\Layout\RemessaTransacaoTipoUm\LayoutTransacaoTipoUm;

class LayoutContext
{
    public $CNAB;
    public function __construct(ReadFileContext $file)
    {
        $this->CNAB = [];

        if(empty($file->conteudo))
            return $this;

        foreach($file->conteudo as $fileName => $linhasCnab){
            if(empty($linhasCnab))
                continue;

            foreach($linhasCnab as $numSequencialRegistro => $linha) {
                if(empty($linha))
                    continue;

                switch($linha->idRegistro){
                    case 0:
                        $layout = new LayoutHeaderLabel($linha);
                        break;
                    case 1:
                        $layout = new LayoutTransacaoTipoUm($linha);
                        break;
                    case 2:
                        $layout = new LayoutMensagemTipoDois($linha);
                        break;
                    case 3:
                        $layout = new LayoutRateioCreditoTipoTres($linha);
                        break;
                }
                $this->CNAB[$fileName][$numSequencialRegistro] = $layout->get();
            }
        }
    }

    public function get()
    {
        if(count($this->CNAB) == 1);
            return current($this->CNAB);

        return $this->CNAB;
    }

    public function getFiles()
    {
        return array_keys($this->CNAB);
    }

    public function countFiles()
    {
        return count($this->CNAB);
    }

    public function countLinhas()
    {
        $map = [];
        foreach($this->CNAB as $fileName => $linhas)
            $map[$fileName] = count($linhas);

        return $map;
    }

    public function isEmpty()
    {
        return is_array($this->CNAB) && empty($this->CNAB);
    }
}