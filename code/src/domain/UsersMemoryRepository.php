<?php


namespace app\domain;


use app\lib\RepositoryInterface;

class UsersMemoryRepository implements RepositoryInterface
{
    private $memoryStore = [];
    private static $instance;


    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function create($user_entity)
    {
        /**
         * @var User $user_entity
         */
        if(!key_exists($user_entity->getId(), $this->memoryStore)){
            $this->memoryStore[$user_entity->getId()] = $user_entity;
        }
    }

    public function update($user_entity)
    {
        /**
         * @var User $user_entity
         */
        if(key_exists($user_entity->getId(), $this->memoryStore)){
            $this->memoryStore[$user_entity->getId()] = $user_entity;
        }
    }

    public function delete($user_entity)
    {
        /**
         * @var User $user_entity
         */
        unset($this->memoryStore[$user_entity->getId()]);
    }

    public function findById($id)
    {
        if(key_exists($id, $this->memoryStore)){
            return $this->memoryStore[$id];
        }
        return null;
    }
}