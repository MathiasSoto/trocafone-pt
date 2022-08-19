<?php


namespace app\domain;


use app\lib\RepositoryInterface;

class ExamsMemoryRepository implements RepositoryInterface
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

    public function create($exam_entity)
    {
        /**
         * @var Exam $exam_entity
         */
        if(!key_exists($exam_entity->getId(), $this->memoryStore)){
            $this->memoryStore[$exam_entity->getId()] = $exam_entity;
        }
    }

    public function update($exam_entity)
    {
        /**
         * @var Exam $exam_entity
         */
        if(key_exists($exam_entity->getId(), $this->memoryStore)){
            $this->memoryStore[$exam_entity->getId()] = $exam_entity;
        }
    }

    public function delete($exam_entity)
    {
        /**
         * @var Exam $exam_entity
         */
        unset($this->memoryStore[$exam_entity->getId()]);
    }

    /**
     * @param int $id
     * @return Exam|null
     */
    public function findById($id)
    {
        if(key_exists($id, $this->memoryStore)){
            return $this->memoryStore[$id];
        }
        return null;
    }
}