<?php


    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Task.php";

    $server = 'mysql:host=localhost;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class TaskTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Task::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $description = "Wash the cat";
            $test_task = new Task($description);

            //act
            $test_task->save();

            //assert
            $result = Task::getAll();
            $this->assertEquals($test_task, $result[0]);
        }

        function test_getAll()
        {
            //arrange
            $description = "Wash the cat";
            $description2 = "Water the roof";
            $test_task = new Task($description);
            $test_task->save();
            $test_task2 = new Task ($description2);
            $test_task2->save();

            $result = Task::getAll();

            $this->assertEquals([$test_task, $test_task2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $description = "Wash the cat";
            $description2 = "Water the roof";
            $test_task = new Task($description);
            $test_task->save();
            $test_task2 = new Task($description2);
            $test_task2->save();

            //Act
            Task::deleteAll();

            //Assert
            $result = Task::getAll();
            $this->assertEquals([], $result);
        }
    }


 ?>
