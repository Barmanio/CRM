<?php
namespace controllers\directions;

use models\directions\DirectionModel;
use models\Check;

class DirectionController
{

    private $check;

    public function __construct()
    {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
        $this->check = new Check($userRole);
    }

    public function index()
    {

        $this->check->requirePermission();

        $directionModel = new DirectionModel();
        $directions = $directionModel->getAllDirections();
        include 'app/views/directions/index.php';

    }

    public function create()
    {
        $this->check->requirePermission();
        include 'app/views/directions/create.php';
    }

    public function store()
    {
        $this->check->requirePermission();
        if (isset($_POST['title']) && isset($_POST['description'])) {
            $title = trim(htmlspecialchars($_POST['title']));
            $description = trim(htmlspecialchars($_POST['description']));

            if (empty($title) || empty($description)) {
                echo "Title or Description fields are required!";
                return;
            }

            $directionModel = new DirectionModel();
            $directionModel->createDirection($title, $description);
        }
        header("Location: /directions");
    }
    public function edit($params)
    {
        $this->check->requirePermission();

        $directionModel = new DirectionModel();
        $direction = $directionModel->getDirectionById($params['id']);

        if (!$direction) {
            echo "Direction not found";
            return;
        }
        include 'app/views/directions/edit.php';

    }

    public function update()
    {
        $this->check->requirePermission();
        if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['description'])) {
            $id = trim($_POST['id']);
            $title = trim(htmlspecialchars($_POST['title']));
            $description = trim(htmlspecialchars($_POST['description']));

            if (empty($title) || empty($description)) {
                echo "Title or description fields are required!";
                return;
            }

            $directionModel = new DirectionModel();
            $directionModel->updateDirection($id, $title, $description);
        }
        header("Location: /directions");
    }

    public function delete($params)
    {
        $this->check->requirePermission();
        $directionModel = new DirectionModel();
        $directionModel->deleteDirection($params['id']);

        header("Location: /directions");

    }


}