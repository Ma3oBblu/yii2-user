<?php
namespace sorokinmedia\user\tests\handlers\UserMeta\actions;

use sorokinmedia\user\handlers\UserMeta\UserMetaHandler;
use sorokinmedia\user\tests\entities\UserMeta\UserMeta;
use sorokinmedia\user\tests\TestCase;
use yii\db\Connection;
use yii\db\Schema;

/**
 * Class CreateUserMetaTest
 * @package sorokinmedia\user\tests\handlers\UserMeta\actions
 *
 * тестирование action create
 */
class CreateUserMetaTest extends TestCase
{
    /**
     * @group user-meta-handler
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testAction()
    {
        $this->initDb();
        $this->initDbAdditional();
        $user_meta = new UserMeta([
            'user_id' => 2
        ]);
        $this->assertTrue((new UserMetaHandler($user_meta))->create());
        $user_meta->refresh();
        $this->assertEquals(2, $user_meta->user_id);
        $this->assertInstanceOf(UserMeta::class, $user_meta);
    }
}