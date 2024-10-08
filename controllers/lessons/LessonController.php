<?php

namespace controllers\lessons;

use models\lessons\LessonModel;
use models\clients\ClientModel;
use models\directions\DirectionModel;
use models\branches\BranchModel;
use models\Check;

class LessonController
{

    private $check;
    public function __construct()
    {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
        $this->check = new Check($userRole);
    }



    public function create()
    {
        $this->check->requirePermission();
		
        $branch = new BranchModel();
        $branches = $branch->getAllBranches();
        $direction = new DirectionModel();
        $directions = $direction->getAllDirections();

        include 'app/views/lessons/create.php';
    }

    public function store()
    {

        $this->check->requirePermission();
        if (isset($_POST['direction_id']) && isset($_POST['day_week']) && isset($_POST['time']) && isset($_POST['branch_id'])) {
            $data['direction_id'] = trim(htmlspecialchars($_POST['direction_id']));
            $data['branch_id'] = trim(htmlspecialchars($_POST['branch_id']));
            $data['day_week'] = trim(htmlspecialchars($_POST['day_week']));
            $data['time'] = trim(htmlspecialchars($_POST['time']));

            $lessonModel = new LessonModel();


            $lessonModel->addLessonBranch( $data['branch_id'], $lessonModel->addLesson($data));
        }
        header("Location: /branches");
    }
    public function edit($params)
    {
        $this->check->requirePermission();

        $lessonModel = new LessonModel();
        $lesson = $lessonModel->getLessonById($params['id']);


        $branch = new BranchModel();
        $branches = $branch->getAllBranches();
        $direction = new DirectionModel();
        $directions = $direction->getAllDirections();


        if (!$lesson) {
            echo "Lesson not found";
            return;
        }

        include 'app/views/lessons/edit.php';
    }


    public function update()
    {
        $this->check->requirePermission();

        if (isset($_POST['id']) && isset($_POST['direction_id']) && isset($_POST['branch_id']) && isset($_POST['day_week']) && isset($_POST['time'])) {
            $data['id'] = trim($_POST['id']);
            $data['direction_id'] = trim(htmlspecialchars($_POST['direction_id']));
            $data['branch_id'] = trim(htmlspecialchars($_POST['branch_id']));
            $data['day_week'] = trim(htmlspecialchars($_POST['day_week']));
            $data['time'] = trim(htmlspecialchars($_POST['time']));


            $lessonModel = new LessonModel();
            $lessonModel->updateLesson($data);


        }
        header("Location: /lessons");
    }

    public function delete($params)
    {
        $this->check->requirePermission();

        $lessonModel = new LessonModel();
        $lessonModel->deleteLesson($params['id']);

        header("Location: /lessons");
    }

    public function lessonsByBranches($params)
    {
        $this->check->requirePermission();
		
        $lessonModel = new LessonModel();
        $lessonByBranch = $lessonModel->getLessonByBranchId($params['id']);

		$branch_id=$params['id'];
        $branchModel = new BranchModel();

        $branchName = $branchModel->getBranchNameById($params['id']);
        $clients = new ClientModel();


        $direction = new DirectionModel();


        foreach ($lessonByBranch as &$lesson) {

            $lesson['direction'] = $direction->getDirectionById(($lesson['direction_id']));
            $lesson['clients'] = $clients->getClientsByLessonId($lesson['id']);
            
        }

        include 'app/views/branches/lessonbybranch.php';
    }


}