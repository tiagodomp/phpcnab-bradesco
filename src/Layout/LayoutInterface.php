<?php


namespace Phpcnab\Bradesco\Layout;


interface LayoutInterface
{
    public function getLinha();

    public function getNumSequencialRegistro();

    public function getIdRegistro();

    public function getTipoRegistro();
}