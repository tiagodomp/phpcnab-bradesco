<?php


namespace Phpcnab\Bradesco;


/**
 * Class BradescoException
 * @package Phpcnab\Bradesco
 *
 * @author Tiago Pereira <tiagodominguespereira@gmail.com>
 */
class BradescoLog
{
    /**
     * BradescoLog constructor.
     * @param string $message
     * @param int $code
     * @param string $type
     * @param $context
     * @copyright (c) 2020, Tiago Pereira
     * @package Phpcnab
     * @subpackage Bradesco
     * @author Tiago Pereira <tiagodominguespereira@gmail.com>
     */
    public function __construct($message = "", $code = 0, $type = "", $context)
    {
        $message = '['.strtoupper($type).'] - '.date('d-m-Y H:i:s T:e').' => '.$message.'';
    }
}