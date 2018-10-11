<?php
namespace sorokinmedia\user\handlers\CompanyUser\actions;

/**
 * Class RemovePermission
 * @package sorokinmedia\user\handlers\CompanyUser\actions
 */
class RemovePermission extends AbstractActionWithPermission
{
    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function execute() : bool
    {
        $this->company_user->removePermission($this->permission);
        return true;
    }
}