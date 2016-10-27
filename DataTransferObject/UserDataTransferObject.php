<?php

namespace SumoCoders\FrameworkMultiUserBundle\DataTransferObject;

use SumoCoders\FrameworkMultiUserBundle\DataTransferObject\Interfaces\UserDataTransferObject
    as UserDataTransferObjectInterface;
use SumoCoders\FrameworkMultiUserBundle\User\Interfaces\User as UserInterface;
use SumoCoders\FrameworkMultiUserBundle\User\User;

class UserDataTransferObject implements UserDataTransferObjectInterface
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $userName;

    /**
     * @var string
     */
    public $displayName;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $plainPassword;

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @param UserInterface $user
     *
     * @return self
     */
    public static function fromUser(UserInterface $user)
    {
        $baseUserTransferObject = new self();
        $baseUserTransferObject->user = $user;
        $baseUserTransferObject->id = $user->getId();
        $baseUserTransferObject->userName = $user->getUsername();
        $baseUserTransferObject->displayName = $user->getDisplayName();
        $baseUserTransferObject->email = $user->getEmail();
        if ($user->hasPlainPassword()) {
            $baseUserTransferObject->plainPassword = $user->getPlainPassword();
        }

        return $baseUserTransferObject;
    }

    /**
     * @return UserInterface
     */
    public function getEntity()
    {
        if ($this->user) {
            $this->user->change($this);

            return $this->user;
        }

        return new User(
            $this->userName,
            $this->plainPassword,
            $this->displayName,
            $this->email
        );
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
}
