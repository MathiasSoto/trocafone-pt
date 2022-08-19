<?php
namespace app\lib;

use app\domain\BooleanQuestion;
use app\domain\DescriptionQuestion;
use app\domain\MultipleChoiceQuestion;
use app\domain\QuestionType;
use app\lib\AbstractFactoryInterface;

class QuestionAbstractFactory implements AbstractFactoryInterface
{
    public static function createQuestion(string $code): QuestionAbstract
    {
        switch ($code){
            case QuestionType::DESCRIPTION_TYPE_CODE:
                return new DescriptionQuestion();
                break;
            case QuestionType::MULTIPLE_CHOICE_TYPE_CODE:
                return new MultipleChoiceQuestion();
                break;
            case QuestionType::BOOLEAN_TYPE_CODE:
                return new BooleanQuestion();
                break;
            default:
                throw new \Exception("Not valid code from QuestionType");
        }
    }

    public static function buildQuestion(string $type, $model): QuestionAbstract
    {
        // TODO: Implement buildQuestion() method.
    }
}