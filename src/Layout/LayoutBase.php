<?php

/*
 * This file is part of the Phpcnab/Bradesco package.
 *
 * (c) Tiago Pereira <tiagodominguespereira@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Phpcnab\Bradesco\Layout;


use Phpcnab\Bradesco\File\ReadFileBase;

/**
 * class LayoutBase
 * @name LayoutBase
 * @copyright (c) 2020, Tiago Pereira
 * @package Phpcnab
 * @subpackage Bradesco
 * @author Tiago Pereira <tiagodominguespereira@gmail.com>
 */
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

    /**
     * LayoutBase constructor.
     * @param string $propiedade
     * @param array $parametros
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     */
    public function __construct($propiedade, $parametros){
        $this->unsetParametros();
        $this->propiedade = (string) $propiedade;
        $this->parametros = (array) $parametros;
    }

    /**
     * Define the parameters, from the line CNAB
     * @name setParametros
     * @param ReadFileBase $linha
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return $this
     */
    public function setParametros(ReadFileBase $linha)
    {
        if(count($this->parametros) < 5)
            return $this->unsetParametros();

        $this->posicaoInicio    = (int) $this->parametros[0]; //int
        $this->posicaoFinal     = (int)  $this->parametros[1]; //int
        $this->nomeCampo        = (string)  $this->parametros[2]; //string
        $this->tamanhoCampo     = (int)  $this->parametros[3]; //int
        $this->tipoCampo        = $this->parametros[4]; //string
        $this->aliasCampo       = (string) $this->propiedade;    //string
        $this->valorCampoArray  = $this->getValueLineCNAB($linha->arrayLinha);
        $this->valorCampo       = null;
        return $this;
    }

    /**
     * Obtains from an array, containing each character of the CNAB line, the corresponding values ​​according to the bradesco manual
     * @name getValueLineCNAB
     * @param array $linhaCNAB
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return array
     */
    private function getValueLineCNAB(array $linhaCNAB){
        return !empty($linhaCNAB)?array_slice($linhaCNAB, $this->posicaoInicio - 1, $this->tamanhoCampo ):[];
    }

    /**
     * Clears parameter values
     * @name unsetParametros
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return $this
     */
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

    /**
     * Gets the value of the field, according to the CNAB manual
     * @name get
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return int|string|null
     */
    public function get()
    {
        return $this->valorCampo;
    }

    /**
     * Gets the value in array of the field, according to the CNAB manual
     * @name getArray
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return array
     */
    public function getArray()
    {
        return $this->valorCampoArray;
    }

    /**
     * Gets the value in string of the field, according to the CNAB manual
     * @name getString
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return string
     */
    public function getString()
    {
        return implode('', $this->valorCampoArray);
    }

    /**
     * Gets the name of the field, according to the CNAB manual
     * @name getName
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return string
     */
    public function getName()
    {
        return $this->nomeCampo;
    }

    /**
     * Check that parameters are valid
     * @name isValid
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return bool
     */
    public function isValid()
    {
        return $this->status && !is_null($this->valorCampo);
    }
}