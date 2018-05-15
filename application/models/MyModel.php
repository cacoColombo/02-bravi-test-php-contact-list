<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyModel extends CI_Model {

    var $client_service = "frontend-client";
    var $auth_key       = "bravi";

    public function check_auth_client(){
        $client_service = $this->input->get_request_header('Client-Service', TRUE);
        $auth_key  = $this->input->get_request_header('Auth-Key', TRUE);

        if($client_service == $this->client_service && $auth_key == $this->auth_key){
            return true;
        } else {
            return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));
        }
    }

    public function login($username,$password)
    {
        $q  = $this->db->select('password,id')->from('users')->where('username',$username)->get()->row();

        if($q == ""){
            return array('status' => 204,'message' => 'Username not found.');
        } else {
            $hashed_password = $q->password;
            $id              = $q->id;
             echo $hashed_password ." ".$password;
        //exit;
            if (hash_equals($hashed_password, crypt($password, $hashed_password))) {
               $last_login = date('Y-m-d H:i:s');
               $token = crypt(substr( md5(rand()), 0, 7));
               $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
               $this->db->trans_start();
               $this->db->where('id',$id)->update('users',array('last_login' => $last_login));
               $this->db->insert('users_authentication',array('users_id' => $id,'token' => $token,'expired_at' => $expired_at));
               if ($this->db->trans_status() === FALSE){
                  $this->db->trans_rollback();
                  return array('status' => 500,'message' => 'Internal server error.');
               } else {
                  $this->db->trans_commit();
                  return array('status' => 200,'message' => 'Successfully login.','id' => $id, 'token' => $token);
               }
            } else {
                echo "Wrong password";
                exit();
               return array('status' => 204,'message' => 'Wrong password.');
            }
        }
    }

    public function logout()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('Authorization', TRUE);
        $this->db->where('users_id',$users_id)->where('token',$token)->delete('users_authentication');
        return array('status' => 200,'message' => 'Successfully logout.');
    }

    public function auth()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('Authorization', TRUE);
        $q  = $this->db->select('expired_at')->from('users_authentication')->where('users_id',$users_id)->where('token',$token)->get()->row();
        if($q == ""){
            return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));
        } else {
            if($q->expired_at < date('Y-m-d H:i:s')){
                return json_output(401,array('status' => 401,'message' => 'Your session has been expired.'));
            } else {
                $updated_at = date('Y-m-d H:i:s');
                $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
                $this->db->where('users_id',$users_id)->where('token',$token)->update('users_authentication',array('expired_at' => $expired_at,'updated_at' => $updated_at));
                return array('status' => 200,'message' => 'Authorized.');
            }
        }
    }

    public function contact_list_data()
    {
        return $this->db->select('id,name,nickname')->from('contacts')->order_by('name','asc')->get()->result();
    }


    public function contact_detail_data($id)
    {
        return $this->db->select('*')
                        ->from('contacts')
                        ->join('contacts_infos', 'contacts.id = contacts_infos.contact_id')
                        ->where('contacts_infos.contact_id', $id)
                        ->get()->result();
    }

    public function contact_create_data($data)
    {
        $this->db->insert('contacts',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    public function contact_info_add_data($data)
    {
        $this->db->insert('contacts_infos', $data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    public function contact_update_data($id, $data)
    {
        $this->db->where('id', $id)->update('contacts', $data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    public function contact_info_update_data($id, $data)
    {
        $this->db->where('id', $id)->update('contacts_infos', $data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    public function contact_delete_data($id)
    {
        $res = $this->db->select('count(*) as count')->from('contacts_infos')->where('contact_id', $id)->get()->result();
        if ($res[0]->count > 0)
        {
            return array('status' => 400, 'message' => 'Remove all infos first', 'count' => $id);
        }
        $this->db->where('id', $id)->delete('contacts');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }

    public function contact_info_delete_data($id)
    {
        $this->db->where('id', $id)->delete('contacts_infos');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }

}
