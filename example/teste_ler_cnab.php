<?php

require __DIR__.'/../autoload.php';

$cnab = new \Phpcnab\Bradesco\LerCnab('./cnab.REM');

if($cnab->isFile()) //Cada cnab é um objeto
    foreach($cnab->get() as $numSequencialRegistro => $linha) //Cada linha do arquivo cnab é um objeto
    {
        var_dump($linha->TipoRegistro);
        foreach($linha->getArray() as $aliasCampo => $campo) //Cada Campo definido no Manual Bradesco é um objeto
        {
            var_dump([$campo->nomeCampo => $campo->valorCampo]);
        }
        exit;
    }

if($cnab->isDir())
    foreach($cnab->get() as $fileName) { //A pasta que conter arquivos CNAB se tranforma em uma matriz
        var_dump($fileName);
        foreach ($fileName as $numSequencialRegistro => $linha) { //Cada linha dos arquivos cnab é um objeto

            var_dump($linha->TipoRegistro);
            foreach($linha->getArray() as $aliasCampo => $campo) //Cada Campo definido no Manual Bradesco é um objeto
            {
                var_dump([$campo->nomeCampo => $campo->valorCampo]);
            }
            exit;
        }
    }

exit;