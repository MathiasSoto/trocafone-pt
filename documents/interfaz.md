Definición de la interfaz de la API
Para las siguientes funcionalidades:

- 1 : Obtener la definición de un examen (título, descripción, preguntas, etc)
- 2 : Enviar las respuestas de un examen y ver el puntaje obtenido.

Crear un documento en el cual se defina:

El endpoint a usar (definir el path y método HTTP, con los parámetros que pueda tener)
Un ejemplo del body del request
Un ejemplo del body de la response
Códigos de respuesta HTTP

--------------
##### Respuesta:


1 : Obtener la definición de un examen (título, descripción, preguntas, etc) 

En este endpoint se definirá una ruta como la siguiente: 

URL: /api/exams/<int:id>
 
Method: GET 

Return codes: 200, 404

Response:
```json
{ 
  "id":1,
  "title":"title",
  "description":"description",
  "questions": [
      {
        "id": 1,
        "question": "question?",
        "order": 1,
        "question_type": 2,
        "question_type_code": "description_question"
      }
  ]
}
```

---------------


2 : Enviar las respuestas de un examen y ver el puntaje obtenido. 

URL: /api/exams/<int:id>/answers 

Method: POST 

Return codes: 200, 404

Request: 

```json
{ 
  "user_id":1, 
  "answers":[
      {
        "question_id":1,
        "value":true
      },
      {
        "question_id":2,
        "value":"esta es la respuesta"
      },
      {
        "question_id":3,
        "value":2
      }
  ]
} 
```

Response:
```json
{ 
  "exam_id":1,
  "user_id":1,
  "correct_answers":2,
  "questions": 3
}
```
