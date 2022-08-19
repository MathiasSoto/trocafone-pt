<?php


namespace app\domain;

use app\domain\Answer;
use app\lib\QuestionAbstract;

class MultipleChoiceQuestion extends QuestionAbstract
{
    private $options;

    public function __construct(string $question = "", Option $correct = null)
    {
        $this->setQuestion($question);
        $this->setCorrect($correct);
        $this->setQuestionType(QuestionType::MULTIPLE_CHOICE_TYPE_CODE);
    }

    public function isCorrect(Answer $answer): bool
    {
        if((int)$this->getCorrect()->getId() == (int)$answer->getValue()){
            return true;
        }
        return false;
    }

    /**
     * @return array
     */
    public function getOptions():array
    {
        return $this->options;
    }

    /**
     * @param Option $options
     * @return MultipleChoiceQuestion
     */
    public function addOption(Option $options)
    {
        $this->options[$options->getId()] = $options;
        return $this;
    }

    /**
     * @param Option $options
     * @return MultipleChoiceQuestion
     */
    public function deleteOption(Option $options){

        unset($this->options[$options->getId()]);
        return $this;
    }

}