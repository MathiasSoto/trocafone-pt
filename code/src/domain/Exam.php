<?php
namespace app\domain;

use app\lib\QuestionAbstract;

class Exam
{

    private $id;
    private $title;
    private $description;

    private $questions = [];

    public function __construct()
    {
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
     * @return Exam
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle():string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Exam
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
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
     * @return Exam
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return array
     */
    public function getQuestions():array{

        return $this->questions;
    }

    /**
     * @param int $id
     * @return QuestionAbstract
     */
    public function getQuestion(int $id):QuestionAbstract{

        return $this->questions[$id];
    }

    /**
     * @param QuestionAbstract $question
     * @return Exam
     */
    public function addQuestion(QuestionAbstract $question){

        $this->questions[$question->getId()] = $question;
        return $this;
    }

    /**
     * @param QuestionAbstract $question
     * @return Exam
     */
    private function deleteQuestion(QuestionAbstract $question){

        unset($this->questions[$question->getId()]);
        return $this;
    }

    /**
     * @return int
     */
    public function getQuestionsCount():int{

        return sizeof($this->questions);
    }

}