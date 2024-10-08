<?php

namespace controllers\clients;

use models\clients\ClientModel;
use models\lessons\LessonModel;
use models\branches\BranchModel;
use models\Check;

class ClientsController
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
        $clientModel = new ClientModel();
        $clients = $clientModel->getAllClients();



        $branchModel = new BranchModel();

        foreach ($clients as &$client) {
            $client['branch'] = $branchModel->getBranchById($client['branch_id']);


        }
        include 'app/views/clients/index.php';

    }

    public function create()
    {
        $this->check->requirePermission();
        $branchesModel = new BranchModel();
        $branches = $branchesModel->getAllBranches();

        include 'app/views/clients/create.php';
    }

    public function store()
    {
        $this->check->requirePermission();
        if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['parent']) && isset($_POST['phone']) && isset($_POST['age']) && isset($_POST['branch_id'])) {
            $clientModel = new ClientModel();
            $data['name'] = trim(htmlspecialchars($_POST['name']));
            $data['surname'] = trim(htmlspecialchars($_POST['surname']));
            $data['parent'] = trim(htmlspecialchars($_POST['parent']));
            $data['phone'] = trim(htmlspecialchars($_POST['phone']));
            $data['age'] = trim(htmlspecialchars($_POST['age']));
            $data['status'] = 'new';
            $data['probe'] = isset($_POST['probe']) ? $_POST['probe'] : 0;
            $data['branch_id'] = trim(htmlspecialchars($_POST['branch_id']));
			$data['visiting']='000000000000000000000000000000000000';
            $clientModel->createClient($data);


        }

        header("Location: /clients");
    }
    public function edit($params)
    {

        $this->check->requirePermission();
        $clientModel = new ClientModel();
        $client = $clientModel->getClientById($params['id']);

        $branchesModel = new BranchModel();
        $branches = $branchesModel->getAllBranches();

        $lesson = new LessonModel();
        $lessons = $lesson->getLessonByBranchId($client['branch_id']);



        foreach ($lessons as &$les) {

            $les['nameLes'] = $lesson->getLessonNameById(($les['id']));
        }


        include 'app/views/clients/edit.php';

    }

    public function update($params)
    {
        $this->check->requirePermission();
        $clientModel = new ClientModel();
        $clientModel->updateClient($_POST);
        $clientModel->removeAllLessonClient($_POST['id']);
        $clientModel->addLessonClient($_POST['id'], $_POST['lessons']);

        header("Location: /clients");
    }

    public function delete($params)
    {
        $this->check->requirePermission();
        $clientModel = new ClientModel();
        $clientModel->deleteClient($params['id']);

        header("Location: /clients");

    }
    
    public function save()
    {

    	
        $clientModel = new ClientModel();
    	$i=1;
	    $visit="";
        $c=-1;
        
        if (isset($_POST['visited'])){
        	foreach($_POST['visited'] as $vis)
        		{
        			$s=explode(" ",$vis);
        			$a=intval ($s[1]);
        			$b=intval ($s[2]);
        			if ($c!=$b){
        				if ($c!=-1){
        					while ($i < 37){
				        		$visit=$visit."0";
				        		$i++;
	        				}
	        				$clientModel->saveClient($visit, $c);
        					
        				}
        				$c=$b;
        				$i=1;
	        			$visit="";
	        			while ($i < $a){
        					$visit=$visit."0";
		        			$i++;
		        		}
		        		$visit=$visit."1";
		        		$i++;
        			} else{
        				while ($i < $a){
        					$visit=$visit."0";
		        			$i++;
		        		}
		        		$visit=$visit."1";
		        		$i++;	
        			}
        		
        	}
        	while ($i < 37){
				$visit=$visit."0";
				$i++;
	        }

	        $clientModel->saveClient($visit, $c);
      
        	
        	
        }
        
    	
		$path=$_POST['id_branch'];
        header("Location: /branches/lessonbybranch/$path");

    }
}