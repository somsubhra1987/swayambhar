<?php
namespace app\lib;

use Yii;
use app\lib\Core;

class UserAccessRule extends \yii\filters\AccessRule
{

    /** @inheritdoc */
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }

        foreach ($this->roles as $role) {
            if ($role === 'user') {
                if (Core::getLoggedCustomerID() && Core::isActiveCustomer()) {
                    return true;
                }
            }
        }

        return false;
    }
}
?>