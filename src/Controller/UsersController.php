<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Auth\DefaultPasswordHasher;
class UsersController extends AppController{
    

    //   signup function
    
    public function signup() 
    {
    
        if ($this->request->is('ajax')) 
        {
            $id = $this->request->getData('id');
            $name = $this->request->getData('name');
            $Email = $this->request->getData('Email');
            $address = $this->request->getData('address');
            $phoneNumber = $this->request->getData('phoneNumber');
            $password = $this->request->getData('password');
            $confirmPassword = $this->request->getData('confirmPassword'); 
            
            // Validate name (alphabet or space)
            $error = 0;
            if (empty($name)) {
                echo "Please enter the name."; // if name is empty
                $error = 1;
                die;
            }
            
            if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
                echo "Invalid name format. Please use only alphabets and spaces.";
                $error = 1;
                die;
            }
  
            if (empty($phoneNumber)) {
                echo "Please enter the phone number.";
                $error = 1;
                die;
            }
            
            if (!preg_match("/^[a-zA-Z0-9]{1,8}$/", $phoneNumber)) {
                echo "Invalid phone number format. Please use alphanumeric characters with a maximum length of 8.";
                $error = 1;
                die;
            }
            if (strpos($password, ' ') !== false) {
                echo "Password must not contain spaces."; // validation for space
                $error = 1;
                die;
            }
            
            if (empty($password)) {
                echo "Please enter the password.";
                $error = 1;
                die;
            }
            
            if (strlen($password) !== 9) {
                echo "Password must be 9 characters long.";
                $error = 1;
                die;
            }   
            if ($error === 0) {
                $users_table = $this->loadModel('Users');
                $existingUser = $users_table->find()->where(['Email' => $Email])->first();
            
                if ($existingUser) {
                    echo "Email  already exists. Please choose another Email .";
                    return;
                }
                $users = $users_table->newEntity(['id' => $id,'name' => $name,'Email' => $Email,'address' => $address,'phoneNumber' => $phoneNumber,'password' => $password
                ]);
            
                if ($users_table->save($users)) {
                    echo "Signup successful";
                    die;
                } else {
                    echo "Please try again.";
                    die;
                   
                }
            }
        }
    } 

    // login funtion
                
    public function login()
{
    $session = $this->request->getSession();

    $Email = $session->read('Email');
    if (!empty($Email)) {
        return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
    }

    if ($this->request->is('POST')) {
        $Email = $this->request->getData('Email');
        $password = $this->request->getData('password');

        // Find email and password
        $user = $this->Users->find()->where(['Email' => $Email, 'password' => $password])->first();

        if ($user) {
            $users_table = TableRegistry::getTableLocator()->get('Users');
            if ($users_table->save($user)) {
                $session->write('Email', $Email);
                $session->write('id', $user->id);

                echo "Login Success";
                die;
            } else {
                echo 'Try again!';
                die;
            }
        } else {
            echo 'Invalid Username or Password';
            die;
        }
    }
}

               
                
            // this is dashboard

            public function dashboard()
            {
            $session = $this->request->getSession();
            $Email =  $session->read('Email');
            
            if(empty($Email))
            {
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }
                    
            $this->loadModel('users');
            $users = $this->Users->find('all')->toArray();
            $this->set(compact('users'));
            $this->render('dashboard');
            }



           // this is login function


            public function logout()
            { 
                 $session = $this->request->getSession();
                 $session->delete('Email');
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }
}



 






