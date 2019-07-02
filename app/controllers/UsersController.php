<?php

namespace App\Controllers;
use App\Core\App;

class UsersController
{
    public function store_user()
    {
        session_start();
        $_SESSION['in']="yes";
        $errors="";
        $users = App::get('database')->is_exist('reg',$_POST['email']);
        if(isset($users[0])){
            $errors.="<br />You already singed up before! you can log in now!";
        }
        else {
            if(!$_POST['name']) $errors.="<br />Please enter your name";
            if(!$_POST['email']) $errors.="<br />Please enter your email";
            else if (!(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))) $errors.="<br />Please enter a valid email";

            if(!$_POST['password']) $errors.="<br />Please enter your password";
            else{
                if(strlen($_POST['password'])<8) $errors.="<br />Please enter a password with at least 8 characters";
                if(!preg_match('`[A-Z]`',$_POST['password'])) $errors.="<br />Please include at least one capital letter";
            }
            if(!$_FILES['user_photo']['name']) $errors.="<br />Please choose a photo to your profile";
        }

        if($errors !=""){
            $_SESSION['error']= $errors;
            $_SESSION['name']=$_POST['name'];
            $_SESSION['email']=$_POST['email'];
            return redirect('');
        }
        else{
            App::get('database')->insert('reg', [
                'name'       => $_POST['name'],
                'email'      => $_POST['email'],
                'password'   => md5($_POST['password']),
                'photo'      => $_FILES['user_photo']['name']
            ] );
            $_SESSION['name']=$_POST['name'];
            $_SESSION['email']=$_POST['email'];
            $_SESSION['password']=$_POST['password'];
            $_SESSION['user_photo']=$_FILES['user_photo']['name'];

            move_uploaded_file($_FILES['user_photo']['tmp_name'],'public/images/'.$_FILES['user_photo']['name']);
            return redirect('dashboard');
        }
    }


    public function login()
    {
        session_start();
        $login_errors="";
        $users = App::get('database')->is_exist('reg',$_POST['email']);

        if(!$_POST['email']) $login_errors.="<br />Please enter your email";
        else if(!isset($users[0])){
            $login_errors.="<br />your mail is not valid you can sign up now!";
        }
        if(!$_POST['password']) $login_errors.="<br />Please enter your password";
        elseif (md5($_POST['password']) != $users[0]->password ) {
            $login_errors.="<br />this password is wrong, try again!";
        }

        if($login_errors !=""){
            $_SESSION['login_error']= $login_errors;
            $_SESSION['logemail']=$_POST['email'];
            return redirect('');
        }else{

            if(!empty($_POST['remember'])){
                setcookie("email",$_POST['email'],time()+(10*360*24*60*60));
                setcookie("pass",$_POST['password'],time()+(10*360*24*60*60));
            }else{
                if(isset($_COOKIE['email'])) setcookie("email","");
                if(isset($_COOKIE['pass'])) setcookie("pass","");
            }
            $_SESSION['id']=$users[0]->id;
            $_SESSION['name']=$users[0]->name;
            $_SESSION['email']=$users[0]->email;
            $_SESSION['password']=$users[0]->password;
            $_SESSION['user_photo']=$users[0]->photo;

            return redirect('dashboard');
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        session_start();
        $_SESSION['out']="yes";
        return redirect('');
    }

    public function update_name()
    {
        session_start();
        App::get('database')->name_update('reg',$_POST['name']);
        return redirect('dashboard');
    }


    public function update_email()
    {
        session_start();
        App::get('database')->email_update('reg',$_POST['email']);
        return redirect('dashboard');
    }


    public function update_password()
    {
        session_start();
        App::get('database')->password_update('reg',$_POST['password']);
        return redirect('dashboard');
    }
    public function update_photo()
    {
        session_start();
        App::get('database')->photo_update('reg',$_FILES['user_photo']['name']);
        return redirect('dashboard');
    }
}
