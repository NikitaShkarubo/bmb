<?php

namespace App\Manager;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserManager
{
    /** @var EncoderFactoryInterface */
    protected $encoderFactory;

    /**
     * UserManager constructor.
     *
     * @param EncoderFactoryInterface $encoderFactory
     */
    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * @param User $user
     *
     * @throws \RuntimeException
     */
    public function updateUserPassword(User $user): void
    {
        $plainPassword = $user->getPlainPassword();

        if (!empty($plainPassword)) {
            $encoder  = $this->encoderFactory->getEncoder($user);
            $password = $encoder->encodePassword($plainPassword, $user->getSalt());
            $user->setPassword($password);
        }
    }

    /**
     * @param $user
     *
     * @throws \RuntimeException
     */
    public function preUpdate($user): void
    {
        if (!$user instanceof User) {
            return;
        }

        $this->updateUserPassword($user);
    }

    /**
     * @param $user
     *
     * @throws \RuntimeException
     */
    public function prePersist($user): void
    {
        if (!$user instanceof User) {
            return;
        }

        $this->updateUserPassword($user);
    }
}
