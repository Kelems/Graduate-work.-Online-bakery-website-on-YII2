<?php

namespace app\components;


class AccessRule extends \yii\filters\AccessRule {

    /**
     * @inheritdoc
     */
    protected function matchRole($user)
    {
        if (empty($this->role_id)) {
            return true;
        }
        foreach ($this->role_id as $role_id) {
            if ($role_id === '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } elseif ($role_id === '@') {
                if (!$user->getIsGuest()) {
                    return true;
                }
            // Check if the user is logged in, and the roles match
            } elseif (!$user->getIsGuest() && $role_id === $user->identity->role_id) {
                return true;
            }
        }

        return false;
    }
}
