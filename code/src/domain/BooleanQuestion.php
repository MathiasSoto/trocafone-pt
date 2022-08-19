<?php


namespace app\domain;


use app\lib\QuestionAbstract;

class BooleanQuestion extends QuestionAbstract
{

    public function __construct(string $question = "", bool $correct = false)
    {
        $this->setQuestion($question);
        $this->setCorrect($correct);

        $this->setQuestionType(QuestionType::BOOLEAN_TYPE_CODE);
    }

    public function isCorrect(Answer $answer): bool
    {
        if((bool)$this->getCorrect() == (bool)$answer->getValue()){
            return true;
        }
        return false;
    }
}