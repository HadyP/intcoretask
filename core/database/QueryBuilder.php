<?php

class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $query = $this->pdo->prepare("select * from {$table}");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS);
    }

    public function insert($table , $para)
    {
        $para_name = implode(', ',array_keys($para));
        $para_value = ':' .implode(', :',array_keys($para) );
        try{
        $query = $this->pdo->prepare("insert into $table ($para_name) values ($para_value)");
        $query->execute($para);
        }catch(Exception $e){
            die('whoops, something went wrong');
        }
    }

    public function is_exist($table , $email)
    {
        try{
        $query = $this->pdo->prepare("select * from {$table} where email=:email");
        $query->bindParam(':email', $email);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS);
        }catch(Exception $e){

            die('whoops, something went wrong');
        }
    }

    public function name_update($table , $name)
    {
        try{

            $query = $this->pdo->prepare("update {$table} set name=:name where id=:email");
            $query->bindParam(':name', $name);
            $query->bindParam(':email', $_SESSION['id']);
            $query->execute();
            $_SESSION['name']=$name;
            }catch(Exception $e){
                die('whoops, something went wrong1');
            }

    }
    public function email_update($table , $email)
    {
        try{

            $query = $this->pdo->prepare("update {$table} set email=:email where id=:id");
            $query->bindParam(':email', $email);
            $query->bindParam(':id', $_SESSION['id']);
            $query->execute();
            $_SESSION['email']=$email;
            }catch(Exception $e){
                die('whoops, something went wrong1');
            }

    }
    public function password_update($table , $password)
    {
        $hash=md5($password);
        try{
            $query = $this->pdo->prepare("update {$table} set password=:password where id=:id");
            $query->bindParam(':password',$hash);
            $query->bindParam(':id', $_SESSION['id']);
            $query->execute();
            }catch(Exception $e){
                die('whoops, something went wrong1');
            }

    }
    public function photo_update($table , $photo)
    {
        try{
            $query = $this->pdo->prepare("update {$table} set photo=:photo where id=:id");
            $query->bindParam(':photo',$photo);
            $query->bindParam(':id', $_SESSION['id']);
            $query->execute();
            $_SESSION['user_photo']=$_FILES['user_photo']['name'];
            move_uploaded_file($_FILES['user_photo']['tmp_name'],'public/images/'.$_FILES['user_photo']['name']);
            }catch(Exception $e){
                die('whoops, something went wrong1');
            }

    }
}