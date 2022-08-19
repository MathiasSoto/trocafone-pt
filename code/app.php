<?php

include_once "./vendor/autoload.php";

use app\domain\Exam;
use app\domain\Option;
use app\domain\QuestionType;
use app\lib\QuestionAbstractFactory;
use app\service\ExamService;
use app\domain\ExamsMemoryRepository;
use app\domain\UsersMemoryRepository;
use app\service\UserService;
use app\domain\User;
use app\lib\RepositoryInterface;

/**
 * ===============================================================
 *                         	Caso de uso
 * ===============================================================
 *
 *  Esta es la definición práctica del caso de uso 2 solicitado:
 *  "Enviar las respuestas de un examen y ver el puntaje obtenido."
 *
 *  Aquí se define un examen y se le asignan 3 preguntas una de cada tipo,
 *  respetando y utilizando como ejemplo la imagen definida en el enunciado
 *  como ejemplo del front-end.
 *
 *  Para la prueba del mismo se simula una petición json a un endpoint del API,
 *  donde mediante la llamada al servicio ExamService se efectúa la corrección de las respuestas
 *  y se devuelve un puntaje del examen en base al número de respuestas correctas.
 */

$examsRepository = ExamsMemoryRepository::getInstance();
$usersRepository = createOneUser(UsersMemoryRepository::getInstance());

$userService = new UserService($usersRepository);
$service = new ExamService($examsRepository, $userService);

function main(ExamService $service){

    $exam = new Exam();
    $exam->setId(1);
    $exam->setTitle("Evaluación de Full Stack Developer");
    $exam->setDescription("En esta evaluación buscamos evaluar tu seniority.");

    /**
     * Esta es una pregunta del tipo verdadero / falso.
     */
    $question_1 = QuestionAbstractFactory::createQuestion(QuestionType::BOOLEAN_TYPE_CODE);
    $question_1->setId(1);
    $question_1->setQuestion("Esta es una pregunta de verdadero falso?");
    $question_1->setCorrect(true);
    $question_1->setOrder(1);

    $exam->addQuestion($question_1);

    /**
     * Esta es una pregunta para que el usuario desarrolle la respuesta.
     */
    $question_2 = QuestionAbstractFactory::createQuestion(QuestionType::DESCRIPTION_TYPE_CODE);
    $question_2->setId(2);
    $question_2->setQuestion("Esta es una pregunta para desarrollar la respuesta?");
    $question_2->setCorrect("esta es la respuesta");
    $question_2->setOrder(2);

    $exam->addQuestion($question_2);

    /**
     * Esta es una pregunta donde el usuario debe seleccionar una opción válida, y sólo una.
     */
    $question_3 = QuestionAbstractFactory::createQuestion(QuestionType::MULTIPLE_CHOICE_TYPE_CODE);
    $question_3->setId(3);
    $question_3->setQuestion("Esta es una pregunta de opciones?");
    $question_3->setOrder(3);

    $option_1 = new Option(1, "Esta es la opción 1");
    $option_2 = new Option(2, "Esta es la opción 2");

    $question_3->addOption($option_1);
    $question_3->addOption($option_2);
    $question_3->setCorrect($option_2);

    $exam->addQuestion($question_3);

    /**
     * Guardamos en el repositorio en memoria
     */
    $service->createExam($exam);

    mock($service);
}

function createOneUser(RepositoryInterface $repository):RepositoryInterface{

    $user = new User();
    $user->setId(1);
    $user->setName("User TEST");

    $repository->create($user);

    return $repository;
}

function mock(ExamService $service){

    /**
     *  Este es un mock de petición donde fueron enviados los resultados de las preguntas
     */
    $request = [
        "exam_id" => 1,
        "user_id" => 1,
        "answers" => [
            [
                "question_id" => 1,
                "value" => true
            ],
            [
                "question_id" => 2,
                "value" => "esta es la respuesta"
            ],
            [
                "question_id" => 3,
                "value" => 2
            ],
        ]
    ];

    $answers = $service->requestDecode($request);
    $exam = $service->findExamById((int) $request["exam_id"]);
    $score = $service->getExamScore($exam, $answers);

    /**
     *  Salida por consola del score del examen,
     *  en este caso se enviaron solo respuestas correctas por lo tanto
     *  el score debe ser 3/3
     */

    output(json_encode($request), $score, $exam->getQuestionsCount());
}

function output($params, $score, $questions_size){
    print_r("REQUEST ==========================================\n");
    print_r($params."\n");
    print_r("OUTPUT ==========================================\n");
    print_r(sprintf("Se enviaron %s respuestas correctas de %s", $score, $questions_size));
}

try {

    main($service);

}catch (\Exception $e){
    print_r($e->getMessage());
}