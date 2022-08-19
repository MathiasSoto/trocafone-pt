<?php
namespace app\domain;

use app\lib\QuestionAbstract;

class Answer
{
    private $id;
    private $user;
    private $exam;
    private $question_id;
    private $value;

    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Answer
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuestionId(): int
    {
        return $this->question_id;
    }

    /**
     * @param int $question_id
     * @return Answer
     */
    public function setQuestionId(int $question_id)
    {
        $this->question_id = $question_id;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser():User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Answer
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Exam
     */
    public function getExam(): Exam
    {
        return $this->exam;
    }

    /**
     * @param Exam $exam
     * @return Answer
     */
    public function setExam(Exam $exam)
    {
        $this->exam = $exam;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return Answer
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }


}