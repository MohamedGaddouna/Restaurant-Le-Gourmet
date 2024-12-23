<?php
require_once '../app/models/User.php';
require_once '../app/controllers/BaseController.php';

class UserController extends BaseController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->addUser($_POST['email'], $_POST['password']);
            header('Location: /phpProject/public');
        }
        $this->render('users/add.php');
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->deleteUser($_POST['id']);
            header('Location: /phpProject/public');
        }
        $this->render('users/delete.php');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->userModel->authentication($_POST['email'], $_POST['password']);
            if ($user) {
                session_start();
                $_SESSION['user'] = $user;
                header('Content-Type: application/json');
                echo json_encode(['stat' => true]);
            } else {
                $error = "invalid email or password";
                header('Content-Type: application/json');
                echo json_encode(['stat' => false]);
            }
        }
    }
    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $test = $this->userModel->getUser($_POST['email']);
            if ($test) {
                header('Content-Type: application/json');
                echo json_encode(['stat' => false]);
            } else {
                $this->userModel->addUser($_POST['email'], $_POST['password']);
                header('Content-Type: application/json');
                echo json_encode(['stat' => true]);
            }
        }
    }
}
