<?php

namespace sorokinmedia\user\tests\handlers\CompanyUser\actions;

use sorokinmedia\user\forms\CompanyUserForm;
use sorokinmedia\user\handlers\CompanyUser\CompanyUserHandler;
use sorokinmedia\user\tests\entities\CompanyUser\CompanyUser;
use sorokinmedia\user\tests\entities\User\User;
use sorokinmedia\user\tests\TestCase;
use Throwable;
use yii\base\InvalidConfigException;
use yii\db\Exception;

/**
 * Class CreateCompanyUserTest
 * @package sorokinmedia\user\tests\handlers\CompanyUser\actions
 */
class CreateCompanyUserTest extends TestCase
{
    /**
     * @group company-user-handler
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testHandler(): void
    {
        $this->initDb();
        $this->initDbAdditional();
        $company_user = new CompanyUser();
        $company_user_form = new CompanyUserForm([
            'user_id' => 2,
            'company_id' => 1,
            'role' => User::ROLE_WORKER,
        ], $company_user);
        $company_user->form = $company_user_form;
        $handler = new CompanyUserHandler($company_user);
        $this->assertTrue($handler->create());
    }
}
