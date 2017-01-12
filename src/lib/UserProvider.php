<?php
/**
 * Created by PhpStorm.
 * User: ldavid
 * Date: 1/12/17
 * Time: 9:54 AM
 */

namespace App;


use Doctrine\DBAL\Connection;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{

    private $db;

    /**
     * UserProvider constructor.
     * @param $db
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }


    /**
     * Loads the user for the given username.
     *
     * This method must throw UsernameNotFoundException if the user is not
     * found.
     *
     * @param string $username The username
     *
     * @return UserInterface
     *
     * @throws UsernameNotFoundException if the user is not found
     */
    public function loadUserByUsername($username)
    {
        $stmt = $this->db->executeQuery(
            "SELECT * FROM users WHERE username = ?",
            [$username]
        );

        if (($row = $stmt->fetch()) === null) {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }

        return new User($row['id'], $row['username'], $row['password'], explode('|', $row['roles']), $row['enabled']);
    }

    /**
     * Refreshes the user for the account interface.
     *
     * It is up to the implementation to decide if the user data should be
     * totally reloaded (e.g. from the database), or if the UserInterface
     * object can just be merged into some internal array of users / identity
     * map.
     *
     * @param UserInterface $user
     *
     * @return UserInterface
     *
     * @throws UnsupportedUserException if the account is not supported
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * Whether this provider supports the given user class.
     *
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class)
    {
        return $class === 'App\User';
    }

}