<?php

namespace Framework;

use Framework\Session;

class Authorization
{
    /**
     * Check if current logged in user owns a resource
     * 
     * @param int $resourceId
     * @return bool
     */
    public static function isOwner($resourceId)
    {
        $sessionUser = Session::get('user');

        if (!$sessionUser || !isset($sessionUser['id'])) {
            return false; // Session not set or user ID missing
        }

        // Compare IDs with consistent data types
        return (int) $sessionUser['id'] === (int) $resourceId;
    }
}
