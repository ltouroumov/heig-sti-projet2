<?php
/**
 * Created by PhpStorm.
 * User: ldavid
 * Date: 1/12/17
 * Time: 1:54 PM
 */

namespace App;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;

class User implements AdvancedUserInterface
{
    private $id;
    private $username;
    private $password;
    private $enabled;
    private $accountNonExpired = true;
    private $credentialsNonExpired = true;
    private $accountNonLocked = true;
    private $roles;

    /**
     * User constructor.
     * @param $id
     * @param $username
     * @param $password
     * @param $roles
     * @param $enabled
     * @param bool $accountNonExpired
     * @param bool $credentialsNonExpired
     * @param bool $accountNonLocked
     */
    public function __construct($id, $username, $password, $roles, $enabled, $accountNonExpired = true, $credentialsNonExpired = true, $accountNonLocked = true)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->roles = $roles;
        $this->enabled = $enabled;
        $this->accountNonExpired = $accountNonExpired;
        $this->accountNonLocked = $accountNonLocked;
        $this->credentialsNonExpired = $credentialsNonExpired;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
    }

    /**
     * Checks whether the user's account has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw an AccountExpiredException and prevent login.
     *
     * @return bool true if the user's account is non expired, false otherwise
     *
     * @see AccountExpiredException
     */
    public function isAccountNonExpired()
    {
        return $this->accountNonExpired;
    }

    /**
     * Checks whether the user is locked.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a LockedException and prevent login.
     *
     * @return bool true if the user is not locked, false otherwise
     *
     * @see LockedException
     */
    public function isAccountNonLocked()
    {
        return $this->accountNonLocked;
    }

    /**
     * Checks whether the user's credentials (password) has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a CredentialsExpiredException and prevent login.
     *
     * @return bool true if the user's credentials are non expired, false otherwise
     *
     * @see CredentialsExpiredException
     */
    public function isCredentialsNonExpired()
    {
        return $this->credentialsNonExpired;
    }

    /**
     * Checks whether the user is enabled.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a DisabledException and prevent login.
     *
     * @return bool true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
    public function isEnabled()
    {
        return $this->enabled;
    }
}