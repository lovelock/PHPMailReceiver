<?php
/**
 * Created by PhpStorm.
 * User: frost
 * Date: 5/5/16
 * Time: 4:22 PM
 */

namespace tests;

use Lovelock\PHPMailReceiver;
use PHPUnit_Framework_TestCase;

require __DIR__ . '/../vendor/autoload.php';


class PHPMailReceiverTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPMailReceiver
     */
    private $mailBox;
    
    public function setUp()
    {
        $this->mailBox = new PHPMailReceiver('bjmail2.kingsoft.cn', 110, 'wangqingchun', 'jR4yH9cS', 'pop3', 'tls');
    }

    public function testGetMessageCount()
    {
        $this->assertGreaterThan(1, $this->mailBox->messageCount());
    }

    public function testGetBody()
    {
        $this->assertNotEmpty($this->mailBox->getBody());
    }

    public function testGetMainContent()
    {
        $this->assertNotEmpty($this->mailBox->getMainContent());
    }
}
