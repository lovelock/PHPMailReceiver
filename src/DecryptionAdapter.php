<?php
/**
 * Created by PhpStorm.
 * User: frost
 * Date: 5/5/16
 * Time: 1:30 PM
 */

namespace Lovelock;


class DecryptionAdapter
{
    private $encryptMethod;

    /**
     * DecryptionAdapter constructor.
     * 
     * @param $encryptMethod
     */
    public function __construct($encryptMethod)
    {
        $this->encryptMethod = $encryptMethod;    
    }

    /**
     * Wrap various decrypt method
     * 
     * @param string $content
     * 
     * @return string
     */
    public function decrypt($content)
    {
        $decryptClass = 'Decryption' . ucfirst($this->encryptMethod);
        
        return (new $decryptClass())->decrypt($content);
    }
}