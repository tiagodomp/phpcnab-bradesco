<?php


namespace Phpcnab\Bradesco\Layout;

use Phpcnab\Bradesco\File\ReadFileContext;
use Phpcnab\Bradesco\Layout\RemessaHeaderLabel\LayoutHeaderLabel;
use Phpcnab\Bradesco\Layout\RemessaMensagemTipoDois\LayoutMensagemTipoDois;
use Phpcnab\Bradesco\Layout\RemessaRateioCreditoTipoTres\LayoutRateioCreditoTipoTres;
use Phpcnab\Bradesco\Layout\RemessaTransacaoTipoUm\LayoutTransacaoTipoUm;

/**
 * class LayoutContext
 * @name LayoutContext
 * @copyright (c) 2020, Tiago Pereira
 * @package Phpcnab/Bradesco
 * @subpackage Layout
 * @author Tiago Pereira <tiagodominguespereira@gmail.com>
 */
class LayoutContext
{
    /**
     * Array containing all valid files
     * @var array
     */
    public $CNAB;


    /**
     * LayoutContext constructor.
     * @param ReadFileContext $file
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     */
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
                if($layout->isValid())
                    $this->CNAB[$fileName][$numSequencialRegistro] = $layout->get();
            }
        }
    }

    /**
     * If only one file is valid: it will return an array containing all ['numberLine': int => Line: object].
     *
     * If two or more files are valid: will return an array containing all ['nameFile': string => ['numberLine': int => Line: object]].
     *
     * @name get
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return array
     */
    public function get()
    {
        if(count($this->CNAB) == 1);
            return current($this->CNAB);

        return $this->CNAB;
    }

    /**
     * Gets valid files
     * @name getFiles
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return array
     */
    public function getFiles()
    {
        return array_keys($this->CNAB);
    }

    /**
     * Counts valid files
     * @name countFiles
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return int
     */
    public function countFiles()
    {
        return count($this->CNAB);
    }

    /**
     * Counts valid lines per file
     * @name lineCount
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return array
     */
    public function lineCount()
    {
        $map = [];
        foreach($this->CNAB as $fileName => $linhas)
            $map[$fileName] = count($linhas);

        return $map;
    }

    /**
     * Check that no files are valid
     * @name isEmpty
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return bool
     */
    public function isEmpty()
    {
        return is_array($this->CNAB) && empty($this->CNAB);
    }

    /**
     * Check that files are valid
     * @name isValid
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return bool
     */
    public function isValid()
    {
        return is_array($this->CNAB) && !empty($this->CNAB);
    }
}