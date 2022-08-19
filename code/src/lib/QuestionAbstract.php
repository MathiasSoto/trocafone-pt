<?php
namespace app\lib;

use app\domain\Answer;

abstract class QuestionAbstract
{
    private $id;
    private $question;
    private $order;
    private $question_type;
    private $correct;

    abstract public function isCorrect(Answer $answer):bool;

    /**
     * @return mixed
     */
    public function getCorrect()
    {
        return $this->correct;
    }

    /**
     * @param mixed $correct
     * @return QuestionAbstract
     */
    public function setCorrect($correct)
    {
        $this->correct = $correct;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return QuestionAbstract
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     * @return QuestionAbstract
     */
    public function setQuestion($question)
    {
        $this->question = $question;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     * @return QuestionAbstract
     */
    public function setOrder(int $order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuestionType()
    {
        return $this->question_type;
    }

    /**
     * @param mixed $question_type
     * @return QuestionAbstract
     */
    public function setQuestionType($question_type)
    {
        $this->question_type = $question_type;
        return $this;
    }


}