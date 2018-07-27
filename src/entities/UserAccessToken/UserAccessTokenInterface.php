<?php
namespace sorokinmedia\user\entities\UserAccessToken;

use sorokinmedia\user\entities\User\AbstractUser;

/**
 * Interface UserAccessTokenInterface
 * @package sorokinmedia\user\entities\UserAccessToken
 */
interface UserAccessTokenInterface
{
    /**
     * генерирует токен
     * @param string $string
     * @return string
     */
    public static function generateToken(string $string) : string;

    /**
     * генерирует время жизни токена
     * @param bool $remember
     * @return int
     */
    public static function generateExpired(bool $remember) : int;

    /**
     * статический конструктор
     * @param AbstractUser $user
     * @param bool $remember
     * @return UserAccessTokenInterface
     */
    public static function create(AbstractUser $user, bool $remember = false) : UserAccessTokenInterface;

    /**
     * деактивирует токен
     * @return bool
     */
    public function deactivate() : bool;
}