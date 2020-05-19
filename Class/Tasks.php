<?php
    class Tasks extends Dbh
    {
        public function getAllTasks()
        {
            $query = "SELECT * FROM tasks";
            $stmt = $this->connect()->query($query);

            // while ($row = $result->fetch())
            // {
            //     echo $row['task_name'] . "</br>";
            // }
            return $res = $stmt->fetchAll();
            // foreach($res as $r)
            // {
            //     echo $r['task_name'] . "</br>";
            // }
        }

        public function getLastInsetedTask()
        {
            $lastId = $this->connect()->query("SELECT MAX(id) FROM tasks");
            // $query = "SELECT task_name FROM tasks WHERE id=$lastId";
            // $stmt = $this->connect()->query($query);
            // echo $stmt->fetch() . "</br>";
            echo $lastId;
        }

        public function number()
        {
            $query = "SELECT * FROM tasks";
            $stmt = $this->connect()->query($query);
            return $stmt->rowCount();
        }

        public function numberOverride()
        {
            $query = "SELECT * FROM tasks";
            $stmt = $this->connect()->query($query);
            echo $stmt->rowCount();            
        }

        public function setTask($task)
        {
            $query = "INSERT INTO tasks(task_name) VALUES(?)";
            $stmt = $this->connect()->prepare($query);
            // $stmt->bindParam(':task', $_REQUEST['task']);
            $res = $stmt->execute([$task]);
            return $res;
        }

        public function delTask($taskId)
        {
            $query = "DELETE FROM tasks WHERE id= ?";

            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$taskId]);
            return $stmt->rowCount();
            // return $num;
        }

        public function todo()
        {
            $query = "SELECT * FROM tasks";
            $stmt = $this->connect()->query($query);
            while($todo = $stmt->fetch())
            {
                echo $todo['id'];
            }
        }
        public function todoChe()
        {
            $query = "SELECT * FROM tasks";
            $stmt = $this->connect()->query($query);
            while($todo = $stmt->fetch())
            {
                echo $todo['id'];
            }
        }

        public function a()
        {
            $todos = $this->connect()->query("SELECT * FROM tasks");
            return $todos;
        }

        public function checked($id)
        {
            $query = "SELECT id, checked FROM tasks WHERE id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$id]);

            $todo = $stmt->fetch();
            $uId = $todo['id'];
            $checked = $todo['checked'];
            // echo "{$uId}, {$checked}";

            $uChecked = $checked ? 0 : 1;
            // echo $uChecked;

            $res = $this->connect()->query("UPDATE tasks SET checked=$uChecked WHERE id=$uId");

            if($res)
            {
                echo $checked;
            }
            else
            {
                echo 'error';
            }
        }

        public function items()
        {
            $query = "SELECT COUNT(checked) FROM tasks WHERE checked=0";
            $stmt = $this->connect()->query($query);

            return $stmt->fetchAll();    
        }    

        public function editTask($taskId, $task)
        {
            $query = "UPDATE tasks SET task_name = ? WHERE id= ?";

            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$task, $taskId]);
            return $stmt;
        }

        public function completed()
        {
            $stmt = $this->connect()->query("SELECT * FROM tasks WHERE checked=1");
            return $stmt->fetchAll();
        }

        public function clearCompleted()
        {
            $stmt = $this->connect()->query("DELETE FROM tasks WHERE checked=1");
        }        
        public function active()
        {
            $stmt = $this->connect()->query("SELECT * FROM tasks WHERE checked=0");
            return $stmt->fetchAll();
        }
    }
?>
