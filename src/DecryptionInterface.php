<?php
/**
 * Created by PhpStorm.
 * User: frost
 * Date: 5/5/16
 * Time: 1:37 PM
 */

namespace Lovelock;


/**
 * Interface EncryptionInterface
 * @package Lovelock
 */
interface DecryptionInterface
{
    /**
     * Decrypt content based on specific encrypt method.
     * 
     * @param string $content
     * 
     * @return mixed
     */
    public function decrypt($content);
}