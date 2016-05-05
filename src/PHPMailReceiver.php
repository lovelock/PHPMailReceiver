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
     * @param string $passwd
     * @param string $protocol
     * @param string $secure
     */
    public function __construct($host, $port, $user, $passwd, $protocol, $secure)
    {
        $sslField = $secure === null ? 'novalidate-cert' : $secure;

        $this->mailBox = imap_open(
            "{$host}:{$port}/{$sslField}/{$protocol}/{$sslField}",
            $user,
            $passwd,
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
    public function getBody($index)
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
    public function getMainContent($index)
    {
        if (null === $index) {
            $index = $this->messageCount();
        }

        $encryptedContent = imap_fetchbody($this->mailBox, $index, 1);

        return (new DecryptionAdapter($this->encryptMethod))->decrypt($encryptedContent);
    }
}