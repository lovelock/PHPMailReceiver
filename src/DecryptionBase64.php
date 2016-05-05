<?php
/**
 * Created by PhpStorm.
 * User: frost
 * Date: 5/5/16
 * Time: 1:39 PM
 */

namespace Lovelock;


class DecryptionBase64 implements DecryptionInterface
{
    private $encryptMethod = 'base64';
    
    /**
     * Decrypt content based on specific encrypt method.
     *
     * @param string $content
     *
     * @return mixed
     */
    public function decrypt($content)
    {
        return base64_decode($content);
    }

    /**
     * @return string
     */
    public function getEncryptMethod()
    {
        return self::$encryptMethod;
    }
}