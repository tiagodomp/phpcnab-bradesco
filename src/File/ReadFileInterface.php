<?php


namespace Phpcnab\Bradesco\File;


interface ReadFileInterface
{
    public function getFiles();

    public function getLinha($nomeArquivo, $numSqRegistro);

    public function getArrayFile();

}