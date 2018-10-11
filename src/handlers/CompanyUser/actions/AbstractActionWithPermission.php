<?php
namespace sorokinmedia\user\handlers\CompanyUser\actions;

use sorokinmedia\user\entities\CompanyUser\{
    AbstractCompanyUserPermission,AbstractCompanyUser
};
use sorokinmedia\user\handlers\CompanyUser\interfaces\ActionExecutable;

/**
 * Class AbstractActionWithPermission
 * @package sorokinmedia\user\handlers\CompanyUser\actions
 *
 * @property AbstractCompanyUser $company_user
 * @property AbstractCompanyUserPermission $permission
 */
abstract class AbstractActionWithPermission extends AbstractAction implements ActionExecutable
{
    protected $permission;

    /**
     * AbstractActionWithPermission constructor.
     * @param AbstractCompanyUser $company_user
     * @param AbstractCompanyUserPermission $permission
     */
    public function __construct(AbstractCompanyUser $company_user, AbstractCompanyUserPermission $permission)
    {
        parent::__construct($company_user);
        $this->permission = $permission;
        return $this;
    }
}