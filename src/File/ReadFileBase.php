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

use Phpcnab\Bradesco\File\ReadFileValidator;

/**
 * Class ReadFileBase
 * @package Phpcnab\Bradesco\File
 * @copyright (c) 2020, Tiago Pereira
 * @package Phpcnab/Bradesco
 * @subpackage File
 * @author Tiago Pereira <tiagodominguespereira@gmail.com>
 */
class ReadFileBase
{
    use ReadFileValidator;

    public $idRegistro;

    public $numSequencialRegistro;

    public $arrayLinha;

    public $stringLinha;

    public $tipoCnab;

    public $tipoCnabExtension;

    /**
     * ReadFileBase constructor.
     * @param integer $idRegistro
     * @param integer $numSequencialRegistro
     * @param array $linha
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage File
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     */
    public function __construct($idRegistro, $numSequencialRegistro, $linha){
        $this->idRegistro               = (int) $idRegistro;
        $this->numSequencialRegistro    = (int) $numSequencialRegistro;
        $this->arrayLinha               = (array) $this->getArrayLinha($linha);
        $this->stringLinha              = (string) $linha;
        $this->tipoCnab                 = (int) $this->getTipoCnab($linha);
        $this->tipoCnabExtension        = (string) $this->getTipoCnabExtension($idRegistro);
    }

    /**
     * Get this object that represents a line from the CNAB file
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage File
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return $this
     */
    public function get()
    {
        return $this;
    }

    /**
     * get an array that represents a line from the CNAB file
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage File
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return array
     */
    public function getArray()
    {
        return $this->arrayLinha;
    }

    /**
     * Get in text that represents a line from the CNAB file
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage File
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return string
     */
    public function getString()
    {
        return $this->stringLinha;
    }

    /**
     * get an number that represents a line of registry from the CNAB file
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage File
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return int
     */
    public function getNumLinhaRegistro()
    {
        return $this->numSequencialRegistro;
    }
}