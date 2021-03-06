<?php

namespace SumoCoders\FrameworkMultiUserBundle\Console;

use SumoCoders\FrameworkMultiUserBundle\Command\DeleteUserHandler;
use SumoCoders\FrameworkMultiUserBundle\DataTransferObject\Interfaces\UserDataTransferObject;
use SumoCoders\FrameworkMultiUserBundle\User\Interfaces\UserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class DeleteUserCommand extends Command
{
    /** @var UserRepository */
    private $userRepository;

    /** @var DeleteUserHandler */
    private $handler;

    public function __construct(UserRepository $userRepository, DeleteUserHandler $handler)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->handler = $handler;
    }

    protected function configure(): void
    {
        $this
            ->setName('sumocoders:multiuser:delete')
            ->setDescription('Delete a user entity')
            ->addArgument(
                'username',
                InputArgument::REQUIRED,
                'The username of the user'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $username = $input->getArgument('username');
        $user = $this->userRepository->findByUsername($username);

        if (!$user) {
            $output->writeln('<error>'.$username.' doesn\'t exists');

            return;
        }

        $baseUserTransferObject = UserDataTransferObject::fromUser($user);

        $this->handler->handle($baseUserTransferObject);

        $output->writeln($username . ' has been deleted');
    }
}
