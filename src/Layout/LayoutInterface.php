<?php


namespace Phpcnab\Bradesco\Layout;


interface LayoutInterface
{
    public function get();

    public function getNumSequencialRegistro();

    public function getIdRegistro();

    public function getTipoRegistro();
}