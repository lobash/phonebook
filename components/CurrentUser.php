<?php


namespace components;


class CurrentUser
{

    /**
     * @return bool
     */
    public static function isLoggedIn(): bool
    {
        return empty($_SESSION['logged_user_id']) === false;
    }

    /**
     * @param int $iId
     * @return void
     */
    public static function loggedIn(int $iId): void
    {
        $_SESSION['logged_user_id'] = $iId;
    }

    /**
     * @return void
     */
    public static function loggedOut(): void
    {
        unset($_SESSION['logged_user_id']);
    }

}