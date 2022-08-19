Definiciones 
-------------------------------------------------- 
 
Para la resolución del problema de deja documentado el modelo de clases, el DER de la base de datos relacional con los mínimos requerimientos para la solución teniendo en cuenta que para la implementación en producción se debe seguir extendiendo. 
 
Se decidió implementar varios patrones de diseño a enumerar: 
 
- Strategy (Para resolver el polimorfismo que representan los diversos tipos de preguntas. Se focalizo principalmente en el método abstracto isCorrect() del cual cada tipo de pregunta hace su implementación) 
- AbstractFactory 
- Repository (Para la gestión de las entidades del modelo) 
- Singleton 
 

Run
--------------------------------------------------

Para poder correr el código se definieron dos métodos posibles, correrlo localmente o en un contenedor de docker. 
Se describe a continuación cada una de las formas posibles. 
  
##### Interprete local 
 
Instalamos las dependencias 
```bash
composer install
```

Corremos el caso de uso
```bash
php ./app.php

REQUEST ==========================================
{"exam_id":1,"user_id":1,"answers":[{"question_id":1,"value":true},{"question_id":2,"value":"esta es la respuesta"},{"question_id":3,"value":2}]}
OUTPUT ==========================================
Se enviaron 3 respuestas correctas de 3
```

Corremos los test
```bash
./vendor/bin/phpunit test
```




##### Docker

Primero creamos la imagen definida en el DockerFile
```bash
docker build --tag trocafone:1.0 .
```

Luego podemos crear el contenedor y correrlo, el cual nos arrojara un 
output del caso de uso y de los test unitarios
```bash
docker run -it --rm --name app trocafone:1.0
```

Salida:
```bash
REQUEST ==========================================
{"exam_id":1,"user_id":1,"answers":[{"question_id":1,"value":true},{"question_id":2,"value":"esta es la respuesta"},{"question_id":3,"value":2}]}
OUTPUT ==========================================
Se enviaron 3 respuestas correctas de 3PHPUnit 9.3.7 by Sebastian Bergmann and contributors.

.......                                                             7 / 7 (100%)

Time: 00:00.003, Memory: 4.00 MB

OK (7 tests, 7 assertions)
```