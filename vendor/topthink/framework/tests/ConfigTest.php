<?php

namespace think\tests;

use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use think\Config;

class ConfigTest extends TestCase
{
    public function testLoad()
    {
        $root = vfsStream::setup();
        $file = vfsStream::newFile('admin.php')->setContent("<?php return ['key1'=> 'value1','key2'=>'value2'];");
        $root->addChild($file);

        $config = new Config();

        $config->load($file->url(), 'admin');

        $this->assertEquals('value1', $config->get('admin.key1'));
        $this->assertEquals('value2', $config->get('admin.key2'));

        $this->assertSame(['key1' => 'value1', 'key2' => 'value2'], $config->get('admin'));
    }

    public function testSetAndGet()
    {
        $config = new Config();

        $config->set([
            'key1' => 'value1',
            'key2' => [
                'key3' => 'value3',
            ],
        ], 'admin');

        $this->assertTrue($config->has('admin.key1'));
        $this->assertEquals('value1', $config->get('admin.key1'));
        $this->assertEquals('value3', $config->get('admin.key2.key3'));

        $this->assertEquals(['key3' => 'value3'], $config->get('admin.key2'));
        $this->assertFalse($config->has('admin.key3'));
        $this->assertEquals('none', $config->get('admin.key3', 'none'));
    }
}
