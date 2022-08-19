<?php


namespace app\domain;


use app\lib\QuestionAbstract;

class DescriptionQuestion extends QuestionAbstract
{
    public function __construct(string $question = "", string $correct = "")
    {
        $this->setQuestion($question);
        $this->setCorrect($correct);
        $this->setQuestionType(QuestionType::DESCRIPTION_TYPE_CODE);
    }

    public function isCorrect(Answer $answer): bool
    {
        if((string)$this->getCorrect() == (string)$answer->getValue()){
            return true;
        }
        return false;
    }
}