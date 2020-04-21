<?php


namespace Phpcnab\Bradesco;

use Phpcnab\Bradesco\File\ReadFileContext;
use Phpcnab\Bradesco\Layout\LayoutContext;

/**
 * Class LerCnab
 * @copyright (c) 2020, Tiago Pereira
 * @package Phpcnab/Bradesco
 * @author Tiago Pereira <tiagodominguespereira@gmail.com>
 */
class LerCnab
{
    private $file;
    private $layout;

    private $status = true;
    private $msg;

    /**
     * LerCnab constructor.
     * @param string $pathFile - Path or directory of CNAB file(s)
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab
     * @subpackage Bradesco
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     */
    public function __construct($pathFile)
    {
        if(!is_dir($pathFile) && !is_file($pathFile)) {
            $this->status = false;
            $this->msg = '(' . $pathFile . ') Não é um caminho válido!';
        }

        $this->file = new ReadFileContext($pathFile);

        if(!$this->file->isValid()){
            $this->status = false;
            $this->msg = '('.$pathFile.') Erro ao tentar abrir o Arquivo!';
        }

        $this->layout = new LayoutContext($this->file);
        if(!$this->layout->isValid()){
            $this->status = false;
            $this->msg = '('.$pathFile.') Erro ao processar, este arquivo não é um CNAB';
        }
    }

    /**
     * Gets valid files
     * @name getFiles
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab
     * @subpackage Bradesco
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return array
     */
    public function get()
    {
        return $this->layout->get();
    }

    /**
     * Gets valid files
     * @name getFiles
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab
     * @subpackage Bradesco
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return array
     */
    public function getFiles()
    {
        return $this->layout->getFiles();
    }

    /**
     * Counts how many lines are in each processed file
     * @name lineCount
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab
     * @subpackage Bradesco
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return array - returns an array containing all: [nameFile: string => countLines: int]
     */
    public function lineCount()
    {
        return $this->layout->lineCount();
    }

    /**
     * Make sure the path passed is a file
     * @name getFiles
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab
     * @subpackage Bradesco
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return boolean
     */
    public function isFile()
    {
        return $this->file->isFile;
    }

    /**
     * Make sure the path passed is a file
     * @name isDir
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab
     * @subpackage Bradesco
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return boolean
     */
    public function isDir()
    {
        return $this->file->isDir;
    }

    /**
     * Check that are valid
     * @name isValid
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab
     * @subpackage Bradesco
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return boolean
     */
    public function isValid()
    {
        return $this->status;
    }

}