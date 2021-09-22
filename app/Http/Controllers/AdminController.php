<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    

    public function index(){
        
          $docRef =  $this->db->collection('users');
        $snapshot = $docRef->where('isAdmin','==',true)->documents();
        $admins = $snapshot;    
        return view ('Admins.index', compact('admins'));
    }
  


    public function create(){

          
       // print_r($user);  
        return view ('Admins.create');
        
    }
    public function enregistrer(Request $request){
        
        
    
        
            $email = $request->Email;
            $password = $request->password;
            if($request->password==$request->password_confirmation){
            $authRef = $this->auth->createUser([
                 'email' => $email,
                'password' => $password
           ]);
           $user = $this->auth->signInWithEmailAndPassword($email, $password);
       
           $newuser = $this->db->collection('users')->document($user->firebaseUserId());
           $newuser->set([
           'FullName' => $request->FullName,
           'isAdmin' => true
           
           ]); 
           session()->flush('success','admin  creer avec success');
            }else{
               
            }

        return redirect('/admins');
    }

    public function store(Request $request){
       
    }
    
    public function edit($id){
        $docRef = $this->db->collection('users')->document($id);
        //$query = $docRef->where('id', '=', $id);
        $snapshot = $docRef->snapshot();
        $admin = $snapshot;

        return view('Admins.edit', compact('admin'));
    }

    public function update($id, Request $Request){

        if (empty($Request['Email']) && empty($Request['password']) ) {
  
            $docRef = $this->db->collection('users')->document($id)
            ->update([
                ['path' => 'FullName', 'value' => $Request->FullName
                ]
                ]);

        }if (!empty($Request['Email']) && !empty($Request['password']) && !empty($Request['password_confirmation']) && $Request['password']==$Request['password_confirmation']) {
           
            $updatePassword =$this->auth->changeUserPassword($id, $Request['passwod']);
            $updatedUser = $this->auth->changeUserEmail($id, $Request['Email']);
            $docRef = $this->db->collection('users')->document($id)
            ->update([
                ['path' => 'FullName', 'value' => $Request['FullName']
                ]
                ]);
        }if (!empty($Request['Email']) && empty($Request['password']) ) {
            $updatedUser = $this->auth->changeUserEmail($id, $Request['Email']);
            $docRef = $this->db->collection('users')->document($id)
            ->update([
                ['path' => 'FullName', 'value' => $Request['FullName']
                ]
                ]);
        }if (empty($Request['Email']) && !empty($Request['password']) && $Request['password']==$Request['password_confirmation'] ) {
            $updatePassword =$this->auth->changeUserPassword($id, $Request['passwod']);
            $docRef = $this->db->collection('users')->document($id)
            ->update([
                ['path' => 'FullName', 'value' => $Request['FullName']
                ]
                ]);
        }

    
        return redirect('/admins');
    }
    
    public function destroy($id){
        $this->auth->deleteUser($id);
        $docRef = $this->db->collection('users')->document($id)->delete();
       
        return redirect('/logout');
    }




}
