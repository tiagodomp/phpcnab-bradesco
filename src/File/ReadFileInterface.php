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

/**
 * Interface ReadFileInterface
 * @copyright (c) 2020, Tiago Pereira
 * @package Phpcnab/Bradesco
 * @subpackage File
 * @author Tiago Pereira <tiagodominguespereira@gmail.com>
 */
interface ReadFileInterface
{
    /**
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage File
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return array
     */
    public function getFiles();

    /**
     * @param string $nomeArquivo
     * @param integer $numSqRegistro
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage File
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return array
     */
    public function getLinha($nomeArquivo, $numSqRegistro);

    /**
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage File
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return array
     */
    public function getArrayFile();

    /**
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage File
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return integer
     */
    public function lineCount();

}