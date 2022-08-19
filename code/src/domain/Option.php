<?php
namespace app\domain;

use app\lib\QuestionAbstract;

class Option
{

    private $id;
    private $description;
    private $question;
    private $isCorrect;

    public function __construct(int $id, string $description)
    {
        $this->setId($id);
        $this->setDescription($description);
    }

    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Option
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription():string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Option
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return QuestionAbstract
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param QuestionAbstract $question
     * @return Option
     */
    public function setQuestion(QuestionAbstract $question)
    {
        $this->question = $question;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsCorrect()
    {
        return $this->isCorrect;
    }

    /**
     * @param mixed $isCorrect
     * @return Option
     */
    public function setIsCorrect($isCorrect)
    {
        $this->isCorrect = $isCorrect;
        return $this;
    }

}