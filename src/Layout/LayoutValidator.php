<?php


namespace Phpcnab\Bradesco\Layout;

trait LayoutValidator
{
    public function transformarValor(LayoutBase $propiedade, $numLinha)
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
            case 'null':
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
            case 'null':
                if(!$this->is_null($propiedade)) {
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

    public function is_number(LayoutBase $propiedade)
    {
        return $propiedade->tipoCampo == 'number' && is_numeric(implode('', $propiedade->valorCampoArray));
    }

    public function is_text(LayoutBase $propiedade)
    {
        return $propiedade->tipoCampo == 'text' && strlen(implode('', $propiedade->valorCampoArray)) > 0;
    }

    public function is_null(LayoutBase $propiedade)
    {
        return $propiedade->tipoCampo == 'null' && strlen(implode('', $propiedade->valorCampoArray)) > 0;
    }

    public function msgDefault(LayoutBase $propiedade, $complemento, $numseqRegistro)
    {
        return "O campo $propiedade->nomeCampo localizado na linha $numseqRegistro, entre as colunas $propiedade->posicaoInicio e $propiedade->posicaoFinal: $complemento";
    }


}