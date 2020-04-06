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
    public function __construct($message = "", $code = 0, $type = "", $context)
    {
        $message = '['.strtoupper($type).'] - '.date('d-m-Y H:i:s T:e').' => '.$message.'';
    }
}