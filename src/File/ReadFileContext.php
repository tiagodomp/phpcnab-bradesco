<?php


namespace Phpcnab\Bradesco\File;


use Phpcnab\Bradesco\File\ExtensionRem\ExtensionRem;

class ReadFileContext
{
    public $path;

    public $isDir = false;

    public $isFile = false;

    public $conteudo = [];

    public function __construct($path){
        $this->path = (string) $path;

        if(is_file($this->path)){
            $file = file($this->path);
            $this->isFile = true;

            if(is_array($file))
                $this->__callExtension($this->path, $file);
        }

        if(is_dir($this->path)){
            $dir = array_diff(scandir($this->path), ['.', '..']);
            $this->isDir = true;
            foreach($dir as $file){
                $filename = $this->path.DIRECTORY_SEPARATOR.$file;
                $file = file($filename);

                if(is_array($file))
                    $this->__callExtension($filename, $file);
            }
        }
    }

    private function __callExtension($fileName, $arrayFile)
    {
        $file = pathinfo($fileName);

        switch(strtoupper($file['extension'])){
            case 'REM':
                $arrayFile = new ExtensionRem($file['filename'], $arrayFile);
                break;
            case 'CSV':
                $arrayFile =  [];
                break;
        }

        if(empty($arrayFile))
            return false;

        $this->conteudo = array_merge($this->conteudo, $arrayFile->getArrayFile());
        return true;
    }
}