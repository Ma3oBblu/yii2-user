<?php

namespace sorokinmedia\user\tests\entities\UserAccessToken;

use sorokinmedia\user\entities\User\UserInterface;
use sorokinmedia\user\entities\UserAccessToken\UserAccessTokenInterface;
use sorokinmedia\user\tests\entities\User\User;
use sorokinmedia\user\tests\TestCase;
use Throwable;
use yii\base\InvalidConfigException;
use yii\db\Exception;

/**
 * Class UserAccessTokenTest
 * @package sorokinmedia\user\tests\entities\User
 */
class UserAccessTokenTest extends TestCase
{
    /**
     * @group user-access-token
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testFields(): void
    {
        $this->initDb();
        $user_access_token = new UserAccessToken();
        $this->assertEquals(
            [
                'user_id',
                'access_token',
                'created_at',
                'updated_at',
                'expired_at',
                'is_active'
            ],
            array_keys($user_access_token->getAttributes())
        );
    }

    /**
     * @group user-access-token
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testRelations(): void
    {
        $this->initDb();
        $user_access_token = UserAccessToken::findOne(['user_id' => 1]);
        $this->assertInstanceOf(UserAccessTokenInterface::class, $user_access_token);
        $this->assertInstanceOf(UserInterface::class, $user_access_token->user);
    }

    /**
     * @group user-access-token
     */
    public function testGenerateToken(): void
    {
        $token = UserAccessToken::generateToken('test_string');
        $this->assertNotNull($token);
        $this->assertIsString($token);
        $this->assertEquals(32, mb_strlen($token));
    }

    /**
     * @group user-access-token
     */
    public function testGenerateExpired(): void
    {
        $time = time();
        $expired = UserAccessToken::generateExpired(false);
        $this->assertGreaterThanOrEqual($time + (60 * 60 * 24), $expired);
        $time_month = time();
        $expired_month = UserAccessToken::generateExpired(true);
        $this->assertGreaterThanOrEqual($time_month + (60 * 60 * 24 * 30), $expired_month);
    }

    /**
     * @group user-access-token
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testInsertModel(): void
    {
        $this->initDb();
        $token = new UserAccessToken([
            'user_id' => 1,
            'access_token' => UserAccessToken::generateToken('test@yandex.ru'),
            'expired_at' => UserAccessToken::generateExpired(false),
            'is_active' => 0,
        ]);
        $this->assertTrue($token->insertModel());
        $token->refresh();
        $this->assertEquals(1, $token->user_id);
        $this->assertNotNull($token->access_token);
        $this->assertEquals(0, $token->is_active);
    }

    /**
     * @group user-access-token
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testDeactivate(): void
    {
        $this->initDb();
        $token = UserAccessToken::findOne(['user_id' => 1]);
        $this->assertTrue($token->deactivate());
        $token->refresh();
        $time = time();
        $this->assertEquals(0, $token->is_active);
        $this->assertLessThanOrEqual($time, $token->expired_at);
    }

    /**
     * @group user-access-token
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testCreate(): void
    {
        $this->initDb();
        $user = User::findOne(1);
        $time = time();
        /** @var UserAccessToken $token */
        $token = UserAccessToken::create($user, true);
        $this->assertEquals(1, $token->is_active);
        $this->assertEquals(1, $token->user_id);
        $this->assertEquals(32, mb_strlen($token->access_token));
        $this->assertGreaterThanOrEqual($time + (60 * 60 * 24 * 30), $token->expired_at);
    }
}
