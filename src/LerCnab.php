<?php


namespace Phpcnab\Bradesco;

use Phpcnab\Bradesco\File\ReadFileContext;
use Phpcnab\Bradesco\Layout\LayoutContext;

class LerCnab
{
    private $file;

    private $layout;

    public function __construct($pathFile)
    {
        if(!is_dir($pathFile) && !is_file($pathFile))
            return ['status' => false, 'msg' => '('.$pathFile.') Não é um caminho válido!'];

        $this->file = new ReadFileContext($pathFile);
        if(empty($this->file))
            return ['status' => false, 'msg' => '('.$pathFile.') Erro ao processar!'];

        $this->layout = new LayoutContext($this->file);
    }

    public function get()
    {
        return $this->layout->get();
    }

    public function getFiles()
    {
        return $this->layout->getFiles();
    }

    public function countLinhas()
    {
        return $this->layout->countLinhas();
    }

    public function isFile()
    {
        return $this->file->isFile;
    }

    public function isDir()
    {
        return $this->file->isDir;
    }

}