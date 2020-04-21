<?php
/*
 * This file is part of the Phpcnab/Bradesco package.
 *
 * (c) Tiago Pereira <tiagodominguespereira@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Phpcnab\Bradesco\File;


use Phpcnab\Bradesco\File\ExtensionRem\ExtensionRem;

/**
 * Class ReadFileContext
 * @package Phpcnab\Bradesco
 * @subpackage File
 */
class ReadFileContext
{
    public $path;

    public $isDir = false;

    public $isFile = false;

    public $conteudo = [];

    /**
     * ReadFileContext constructor.
     * @param string $path
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab
     * @subpackage Bradesco
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     */
    public function __construct($path){
        $this->path = (string) $path;

        if(is_file($this->path)){
            $file = file($this->path);
            $this->isFile = true;

            if(is_array($file))
                $this->sueByExtension($this->path, $file);
        }

        if(is_dir($this->path)){
            $dir = array_diff(scandir($this->path), ['.', '..']);
            $this->isDir = true;
            foreach($dir as $file){
                $filename = $this->path.DIRECTORY_SEPARATOR.$file;
                $file = file($filename);

                if(is_array($file))
                    $this->sueByExtension($filename, $file);
            }
        }
    }

    /**
     * Processes the file according to its extension
     * @name sueByExtension
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab
     * @subpackage Bradesco
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return bool
     */
    private function sueByExtension($fileName, $arrayFile)
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

    /**
     * Check that files are valid
     * @name isValid
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab
     * @subpackage Bradesco
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return bool
     */
    public function isValid()
    {
        return !empty($this->conteudo);
    }
}