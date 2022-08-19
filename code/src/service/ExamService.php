<?php
namespace app\service;

use app\domain\Answer;
use app\domain\Exam;
use app\domain\ExamsMemoryRepository;
use app\exceptions\RequestException;
use app\lib\RepositoryInterface;

class ExamService
{
    /**
     * @var ExamsMemoryRepository
     */
    private $examsRepository;
    private $userService;

    public function __construct(RepositoryInterface $examsRepository, UserService $userService)
    {
        $this->examsRepository = $examsRepository;
        $this->userService = $userService;
    }

    public function requestDecode($request_data):array{

        $answers = [];
        if(key_exists("answers",$request_data)){

            $exam_id = (int)$request_data["exam_id"];
            $user_id = (int)$request_data["user_id"];

            foreach ($request_data["answers"] as $answer_data){

                $answer = new Answer();
                $exam = $this->examsRepository->findById($exam_id);

                $answer->setExam($exam);
                $answer->setUser($this->userService->findUserById($user_id));
                $answer->setQuestionId((int)$answer_data["question_id"]);
                $answer->setValue($answer_data["value"]);

                $answers[] = $answer;
            }

            return $answers;
        }

        throw new RequestException("Not valid request parameters");
    }

    public function getExamScore(Exam $exam, array $answers):int{

        $score = 0;

        foreach ($answers as $answer){

            /** @var Answer $answer */

            if($exam->getQuestion((int)$answer->getQuestionId())->isCorrect($answer)){
                $score++;
            }
        }

        return $score;
    }

    public function findExamById(int $id) : Exam{

        return $this->examsRepository->findById($id);
    }

    public function createExam(Exam $exam){

        return $this->examsRepository->create($exam);
    }


}