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

/**
 * trait LayoutValidator
 * @name LayoutValidator
 * @copyright (c) 2020, Tiago Pereira
 * @package Phpcnab
 * @subpackage Bradesco
 * @author Tiago Pereira <tiagodominguespereira@gmail.com>
 */
trait LayoutValidator
{
    /**
     * Transform the value corresponds to the type defined in the Bradesco manual
     * @param LayoutBase $propiedade
     * @param $numLinha
     * @name transformValue
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return LayoutBase $propiedade
     */
    public function transformValue(LayoutBase $propiedade, $numLinha)
    {
        switch($propiedade->tipoCampo){
            case 'number':
                $pv = $propiedade->valorCampoArray;
                $pv = implode('', $pv);
                if(is_numeric($pv))
                    $propiedade->valorCampo = (int) $pv;

                break;
            case 'text':
                $pv = implode('', $propiedade->valorCampoArray);
                $propiedade->valorCampo = (strlen($pv) == $propiedade->tamanhoCampo)?$pv:'';
                break;
            case 'blank':
                $pv = implode('', $propiedade->valorCampoArray);
                $propiedade->valorCampo = (strlen($pv) == $propiedade->tamanhoCampo)
                    ?$pv
                    :str_repeat(' ', $propiedade->tamanhoCampo);
                break;
            default:
                $propiedade->status = false;
                $propiedade->msg = $this->msgDefault($propiedade, '(Erro) Tipo de campo indefinido', $numLinha);
                break;
        }
        return $propiedade;
    }

    /**
     * Checks if the value corresponds to the type defined in the Bradesco manual
     * @param LayoutBase $propiedade
     * @param integer $numLinha
     * @name validateDefault
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return LayoutBase $propiedade
     */
    public function validateDefault(LayoutBase $propiedade, $numLinha)
    {
        switch($propiedade->tipoCampo){
            case 'number':
                if(!$this->is_number($propiedade)) {
                    $propiedade->status     = false;
                    $propiedade->valorCampo = null;
                    $propiedade->msg        = $this->msgDefault($propiedade, '(Erro) É obrigatório ser um campo numérico', $numLinha);
                }
                break;
            case 'text':
                if(!$this->is_text($propiedade)) {
                    $propiedade->status     = false;
                    $propiedade->valorCampo = null;
                    $propiedade->msg        = $this->msgDefault($propiedade, '(Erro) É obrigatório ser um campo alfanumérico', $numLinha);
                }
                break;
            case 'blank':
                if(!$this->is_blank($propiedade)) {
                    $propiedade->status     = false;
                    $propiedade->valorCampo = null;
                    $propiedade->msg        = $this->msgDefault($propiedade, '(Erro) É obrigatório ser um campo em branco', $numLinha);
                }
                break;
            default:
                $propiedade->status     = false;
                $propiedade->valorCampo = null;
                $propiedade->msg        = $this->msgDefault($propiedade, '(Erro) Tipo de campo indefinido', $numLinha);
                break;
        }
        return $propiedade;
    }

    /**
     * Checks if the value of the field is numeric
     * @param LayoutBase $propiedade
     * @name is_number
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return bool
     */
    public function is_number(LayoutBase $propiedade)
    {
        return $propiedade->tipoCampo == 'number' && is_numeric(implode('', $propiedade->valorCampoArray));
    }

    /**
     * Checks if the value of the field is text
     * @param LayoutBase $propiedade
     * @name is_text
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return bool
     */
    public function is_text(LayoutBase $propiedade)
    {
        return $propiedade->tipoCampo == 'text' && strlen(implode('', $propiedade->valorCampoArray)) > 0;
    }

    /**
     * Checks if the value of the field is blank
     * @param LayoutBase $propiedade
     * @name is_blank
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return bool
     */
    public function is_blank(LayoutBase $propiedade)
    {
        return $propiedade->tipoCampo == 'blank' && strlen(implode('', $propiedade->valorCampoArray)) > 0;
    }

    /**
     * @param LayoutBase $propiedade
     * @param string $complemento
     * @param integer $numseqRegistro
     * @name msgDefault
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return string
     */
    public function msgDefault(LayoutBase $propiedade, $complemento, $numseqRegistro)
    {
        return "O campo $propiedade->nomeCampo localizado na linha $numseqRegistro, entre as colunas $propiedade->posicaoInicio e $propiedade->posicaoFinal: $complemento";
    }


}