<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

use app\domain\QuestionType;
use app\lib\RepositoryInterface;
use app\domain\ExamsMemoryRepository;
use app\domain\UsersMemoryRepository;
use app\lib\QuestionAbstractFactory;
use app\service\ExamService;
use app\domain\Exam;
use app\domain\User;
use app\service\UserService;

class ExamsTest extends TestCase
{
    public function testGetExamRepository():RepositoryInterface{

        $examsRepository = ExamsMemoryRepository::getInstance();
        $this->assertInstanceOf(RepositoryInterface::class, $examsRepository);
        return $examsRepository;
    }

    public function testGetUsersRepositoryOneUser():RepositoryInterface{

        $usersRepository = UsersMemoryRepository::getInstance();

        $user = new User();
        $user->setId(1)->setName("User TEST");

        $usersRepository->create($user);

        $this->assertInstanceOf(RepositoryInterface::class, $usersRepository);
        return $usersRepository;
    }

    /**
     * @depends testGetUsersRepositoryOneUser
     */
    public function testGetUserService(RepositoryInterface $usersRepository):UserService{

        $service = new UserService($usersRepository);

        $this->assertInstanceOf(UserService::class, $service);
        return $service;
    }

    /**
     * @depends testGetExamRepository
     */
    public function testAddNewExam(RepositoryInterface $repository):RepositoryInterface{

        $exam = new Exam();
        $exam->setId(1);
        $exam->setTitle("title");
        $exam->setDescription("description");

        $question = QuestionAbstractFactory::createQuestion(QuestionType::BOOLEAN_TYPE_CODE);
        $question->setId(1);
        $question->setQuestion("question?");
        $question->setCorrect(true);

        $exam->addQuestion($question);

        $question_2 = QuestionAbstractFactory::createQuestion(QuestionType::DESCRIPTION_TYPE_CODE);
        $question_2->setId(2);
        $question_2->setQuestion("question?");
        $question_2->setCorrect("test");

        $exam->addQuestion($question_2);

        $repository->create($exam);

        $this->assertInstanceOf(Exam::class, $repository->findById(1));

        return $repository;
    }

    /**
     * @depends testAddNewExam
     * @depends testGetUserService
     */
    public function testGetService(RepositoryInterface $examsRepository, UserService $userService):ExamService{

        $service = new ExamService($examsRepository, $userService);

        $this->assertInstanceOf(ExamService::class, $service);
        return $service;
    }

    /**
     * @depends testGetService
     */
    public function testScoreExamBollQuestion(ExamService $service): void
    {
        $request = [
            "exam_id" => 1,
            "user_id" => 1,
            "answers" => [
                [
                    "question_id" => 1,
                    "value" => true
                ]
            ]
        ];

        $answers = $service->requestDecode($request);
        $exam = $service->findExamById((int) $request["exam_id"]);
        $score = $service->getExamScore($exam, $answers);

        $this->assertEquals(1, $score);
    }

    /**
     * @depends testGetService
     */
    public function testScoreExamDescriptionQuestion(ExamService $service): void
    {
        $request = [
            "exam_id" => 1,
            "user_id" => 1,
            "answers" => [
                [
                    "question_id" => 2,
                    "value" => "test"
                ]
            ]
        ];

        $answers = $service->requestDecode($request);
        $exam = $service->findExamById((int) $request["exam_id"]);
        $score = $service->getExamScore($exam, $answers);

        $this->assertEquals(1, $score);
    }
}