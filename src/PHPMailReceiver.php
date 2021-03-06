<?php
/**
 * Created by PhpStorm.
 * User: frost
 * Date: 5/5/16
 * Time: 1:11 PM
 */

namespace Lovelock;

class PHPMailReceiver
{
    private $mailBox;
    private $encryptMethod = 'base64';

    /**
     * PHPMailReceiver constructor.
     *
     * @param string $host
     * @param integer $port
     * @param string $user
     * @param string $password
     * @param string $protocol
     * @param bool|string $secure
     */
    public function __construct($host, $port, $user, $password, $protocol, $secure = false)
    {
        $mailBoxString = "{{$host}:{$port}";
        if ($secure) {
            $mailBoxString .= '/novalidate-cert/' . $protocol . '/' . $secure . '}';
        } else {
            $mailBoxString .= '/' . $protocol . '}';   
        }

        $this->mailBox = \imap_open(
            $mailBoxString,
            $user,
            $password,
            0,
            0,
            ['DISABLE_AUTHENTICATOR' => 'GSSAPI']
        );
    }

    /**
     * Fetch the total count of messages of the current mail box.
     *
     * @return integer
     */
    public function messageCount()
    {
        return imap_num_msg($this->mailBox);
    }

    /**
     * Fetch email body according to index, if index is not provided, the latest email body will be used.
     *
     * @param integer|null $index
     *
     * @return string
     */
    public function getBody($index = null)
    {
        if (null === $index) {
            $index = $this->messageCount();
        }

        return imap_body($this->mailBox, $index);
    }


    /**
     * Fetch Main content of the email body, if index is not provided, the latest will be used.
     *
     * @param integer $index
     *
     * @return string
     */
    public function getMainContent($index = null)
    {
        if (null === $index) {
            $index = $this->messageCount();
        }

        $encryptedContent = \imap_fetchbody($this->mailBox, $index, 1);

        return (new DecryptionAdapter($this->encryptMethod))->decrypt($encryptedContent);
    }
}