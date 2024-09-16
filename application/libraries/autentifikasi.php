<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('STATUS_ACTIVATED', 'Enable');
define('STATUS_NOT_ACTIVATED', 'Disable');
define('ALLOW', 'Admin');
define('NOT_ALLOW', 'User');

Class Autentifikasi {
    private $ci;
    private $error =  array();
    
    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->model('akses_m');
    }
    
    public function login($nik,$password) {
        if ((strlen($nik) > 0) AND (strlen($password) > 0)) {
            if ($user = $this->ci->akses_m->get_by_nik($nik)) {
                if ($user->password == md5($password)) {
                    $this->ci->session->set_userdata(array(
				'id_akses' => $user->id_akses,
				'nik'	   => $user->nik,
				'status'   => ($user->status == Enable) ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED,
                                'level'	   => $user->level,                                
                    ));
                    
                    if($user->status == Disable){
                        $this->error = (array('status'=>'Status belum aktif'));
                    } else {
                        return true;
                    }
                    
                }
                $this->error = array('password'=>'Password Keliru');
            }
            $this->error = array('login'=>'Login Tidak Benar');
        }
        return FALSE;
    }
    
    public function logout() {
        $this->ci->session->set_userdata(array('id_akses' => '', 'nik' => '', 'status' => '', 'level' => ''));
		$this->ci->session->sess_destroy();
    }
    
//    public function tambah($username,$email,$password,$level) {
//        $data = array( 'username'=>$username,
//                        'email'=>$email,
//                        'password'=>md5($password),
//                        'level'=>$level
//                        );
//        if($this->ci->user_m->cek_username($username)){
//            if($this->ci->user_m->insert($data)){
//                return true;
//            }
//        }
//        return false;
//    }
    
//    public function ubah($id,$username,$email,$password,$level){
//        $data = array( 'username'=>$username,
//                        'email'=>$email,
//                        'password'=>md5($password),
//                        'level'=>$level,
//                        );
//        if($this->ci->user_m->cek_username($username,TRUE) == $id){
//            if($this->ci->user_m->update($id,$data)){
//                return true;
//            }
//        }
//        return false;
//    }
    
    public function sudah_login($activated = TRUE) {
        return $this->ci->session->userdata('status') === ($activated ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED);
    }
    
    public function role($level = array()) {
        foreach ($level as $key=>$val){
            $status = $this->ci->session->userdata('level') == $val ? ALLOW : NOT_ALLOW;
            if ($status == Admin){break;}
        }
        return $status;
    }
    
    
}

?>