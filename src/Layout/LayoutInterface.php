<?php

/*
 * This file is part of the Phpcnab/Bradesco package.
 *
 * (c) Tiago Pereira <tiagodominguespereira@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Phpcnab\Bradesco\Layout;

/**
 * interface LayoutInterface
 * @name LayoutInterface
 * @copyright (c) 2020, Tiago Pereira
 * @package Phpcnab/Bradesco
 * @subpackage Layout
 * @author Tiago Pereira <tiagodominguespereira@gmail.com>
 */
interface LayoutInterface
{

    /**
     * Gets an object representing the line, according to the Bradesco manual and its type of record
     * @name get
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return $this
     */
    public function get();

    /**
     * Gets the line, divided into an array, according to the Bradesco manual and its type of record
     * @name getArray
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return array
     */
    public function getArray();

    /**
     * Gets the sequential line registration number, defined in the Bradesco manual
     * @name getNumSequencialRegistro
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return integer
     */
    public function getNumSequencialRegistro();

    /**
     * Gets the line registration identification, defined in the Bradesco manual
     * @name getIdRegistro
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return integer
     */
    public function getIdRegistro();

    /**
     * Gets the line record type, defined in the Bradesco manual
     * @name getTipoRegistro
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return string
     */
    public function getTipoRegistro();

    /**
     * Check that line are valid
     * @name isValid
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab/Bradesco
     * @subpackage Layout
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     * @return bool
     */
    public function isValid();
}