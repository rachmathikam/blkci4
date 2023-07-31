<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\UserModel;
  
class Login extends Controller
{
    public function index()
    {
        helper(['form']);
        echo view('pages/auth/login');
    } 
  
    public function auth()
    {
        $session = session();
        $userModel = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        
        $data = $userModel->where('username', $username)->first();
        
        if($data){
            $pass = $data['password'];
            
            if($pass == $password){
                $ses_data = [
                    'id_user' => $data['id_user'],
                    'name' => $data['name'],
                    'username' => $data['username'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            
            }else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('/');
            }
        }else{
            $session->setFlashdata('msg', 'username does not exist.');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}