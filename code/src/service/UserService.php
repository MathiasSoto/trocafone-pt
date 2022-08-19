<?php
namespace app\service;

use app\domain\User;
use app\domain\UsersMemoryRepository;
use app\lib\RepositoryInterface;

class UserService
{
    /**
     * @var UsersMemoryRepository
     */
    private $usersRepository;

    public function __construct(RepositoryInterface $usersRepository){
        $this->usersRepository = $usersRepository;
    }

    public function findUserById(int $id) : User{

        return $this->usersRepository->findById($id);
    }

    public function createUser(User $user){

        return $this->usersRepository->create($user);
    }


}