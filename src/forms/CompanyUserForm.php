<?php
namespace sorokinmedia\user\forms;

use sorokinmedia\user\entities\CompanyUser\AbstractCompanyUser;
use yii\base\Model;

/**
 * Class CompanyUserForm
 * @package common\components\company\forms
 *
 * @property int $company_id
 * @property int $user_id
 * @property string $role
 */
class CompanyUserForm extends Model
{
    public $company_id;
    public $user_id;
    public $role;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'user_id', 'role'], 'required'],
            [['company_id', 'user_id'], 'integer'],
            [['role'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'company_id' => \Yii::t('app', 'Компания'),
            'user_id' => \Yii::t('app', 'Пользователь'),
            'role' => \Yii::t('app', 'Роль'),
        ];
    }

    /**
     * CompanyUserForm constructor.
     * @param array $config
     * @param AbstractCompanyUser|null $companyUser
     */
    public function __construct(array $config = [], AbstractCompanyUser $companyUser = null)
    {
        if (!is_null($companyUser)){
            $this->company_id = $companyUser->company_id;
            $this->user_id = $companyUser->user_id;
            $this->role = $companyUser->role;
        }
        parent::__construct($config);
    }
}