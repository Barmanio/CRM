<?php

namespace controllers\branches;

use models\branches\BranchModel;
use models\Check;

class BranchController
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
        $branchModel = new BranchModel();
        $branches = $branchModel->getAllBranches();
        include 'app/views/branches/index.php';

    }

    public function create()
    {
        $this->check->requirePermission();
        include 'app/views/branches/create.php';
    }

    public function store()
    {
        $this->check->requirePermission();
        if (isset($_POST['title']) && isset($_POST['address'])) {
            $title = trim(htmlspecialchars($_POST['title']));
            $address = trim(htmlspecialchars($_POST['address']));

            if (empty($title) || empty($address)) {
                echo "Title or Address are required!";
                return;
            }

            $branchModel = new BranchModel();
            $branchModel->createBranch($title, $address);
        }

        header("Location: /branches");
    }
    public function edit($params)
    {
        $this->check->requirePermission();
        $branchModel = new BranchModel();
        $branch = $branchModel->getBranchById($params['id']);

        if (!$branch) {
            echo "Branch not found";
            return;
        }
        include 'app/views/branches/edit.php';

    }

    public function update($params)
    {
        $this->check->requirePermission();

        if (isset($params['id']) && isset($_POST['title']) && isset($_POST['address'])) {
            $id = trim($params['id']);
            $title = trim(htmlspecialchars($_POST['title']));
            $address = trim(htmlspecialchars($_POST['address']));
            $description = trim(htmlspecialchars($_POST['description']));
            if (empty($title) || empty($address)) {
                echo "Title or Address are required";
                return;
            }

            $branchModel = new BranchModel();
            $branchModel->updateBranch($id, $title, $address, $description);
        }
        header("Location: /branches");
    }

    public function delete($params)
    {
        $this->check->requirePermission();
        $branchModel = new BranchModel();
        $branchModel->deleteBranch($params['id']);

        header("Location: /branches");

    }
}