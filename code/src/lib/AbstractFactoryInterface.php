<?php


namespace app\lib;


use app\domain\QuestionType;

interface AbstractFactoryInterface
{
    public static function createQuestion(string $type):QuestionAbstract;
    public static function buildQuestion(string $type, $model):QuestionAbstract;
}