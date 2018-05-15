<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function list()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->MyModel->contact_list_data();
	    			json_output($response['status'],$resp);
		        }
			}
		}
	}

	public function detail($id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->MyModel->contact_detail_data($id);
					json_output($response['status'],$resp);
		        }
			}
		}
	}

	public function add()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->auth();
		        $respStatus = $response['status'];
		        if($response['status'] == 200){
					$params = json_decode(file_get_contents('php://input'), TRUE);
					if ($params['name'] == "" || $params['user_id'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400, 'message' =>  'Name and user_id cannot be empty');
					} else {
		        		$resp = $this->MyModel->contact_create_data($params);
					}
					json_output($respStatus,$resp);
		        }
			}
		}
	}

	public function addinfo($id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->auth();
		        $respStatus = $response['status'];
		        if($response['status'] == 200){
					$params = json_decode(file_get_contents('php://input'), TRUE);
					if ($params['description'] == "" || $params['value'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400, 'message' =>  'Description, Value cannot be empty');
					} else {
						$params['contact_id'] = $id;
		        		$resp = $this->MyModel->contact_info_add_data($params);
					}
					json_output($respStatus,$resp);
		        }
			}
		}
	}

	public function update($id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'PUT' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->auth();
		        $respStatus = $response['status'];
		        if($response['status'] == 200){
					$params = json_decode(file_get_contents('php://input'), TRUE);
					$params['updated_at'] = date('Y-m-d H:i:s');
					if ($params['name'] == "" || $params['user_id'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Name and user_id can\'t be empty');
					} else {
		        		$resp = $this->MyModel->contact_update_data($id,$params);
					}
					json_output($respStatus,$resp);
		        }
			}
		}
	}

	public function updateinfo($id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'PUT' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->auth();
		        $respStatus = $response['status'];
		        if($response['status'] == 200){
					$params = json_decode(file_get_contents('php://input'), TRUE);
					$params['updated_at'] = date('Y-m-d H:i:s');
					if ($params['description'] == "" || $params['value'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400, 'message' =>  'Description, Value and id cannot be empty');
					} else {
						$param['contact_id'] = $id;
		        		$resp = $this->MyModel->contact_info_update_data($id, $params);
					}
					json_output($respStatus,$resp);
		        }
			}
		}
	}

	public function delete($id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'DELETE' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->MyModel->contact_delete_data($id);
					json_output($response['status'],$resp);
		        }
			}
		}
	}

	public function deleteinfo($id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'DELETE' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->MyModel->contact_info_delete_data($id);
					json_output($response['status'],$resp);
		        }
			}
		}
	}

}
