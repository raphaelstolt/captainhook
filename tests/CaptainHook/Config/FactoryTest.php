<?php
/**
 * This file is part of CaptainHook.
 *
 * (c) Sebastian Feldmann <sf@sebastian.feldmann.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace sebastianfeldmann\CaptainHook\Config;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests Factory::create
     */
    public function testCreate()
    {
        $config = Factory::create(realpath(__DIR__ . '/../../files/config/valid.json'));

        $this->assertTrue(is_a($config, '\\sebastianfeldmann\\CaptainHook\\Config'));
        $this->assertTrue($config->getHookConfig('pre-commit')->isEnabled());
        $this->assertEquals(1, count($config->getHookConfig('pre-commit')->getActions()));
    }
}
