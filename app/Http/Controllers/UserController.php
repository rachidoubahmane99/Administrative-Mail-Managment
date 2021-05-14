<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use \Kreait\Firebase\Database;
use Google\Cloud\Firestore\FirestoreClient;
use GPBMetadata\Google\Firestore\Admin\V1\Index;
use Google\Cloud\Firestore\DocumentSnapshot;
class UserController extends Controller
{
    

    public function index(){
        
        $docRef = $this->db->collection('users');
        $snapshot = $docRef->documents();
        $user = $snapshot;   
        return view ('user.index', compact('user'));
    }
  


    public function create(){

          
      
        $docRef = $this->db->collection('Departments');
        $snapshot = $docRef->documents();
        $departement = $snapshot;   
       // print_r($user);  
        return view ('user.create', compact('departement')); 
       
        
    }

    public function store(Request $request){


            $email = $request->Email;
            $password = $request->password;
            $authRef = $this->auth->createUser([
                 'email' => $email,
                'password' => $password
           ]);
           $user = $this->auth->signInWithEmailAndPassword($email, $password);
       
           $newuser = $this->db->collection('users')->document($user->firebaseUserId());
           $newuser->set([
           'FullName' => $request->FullName,
            'Departement' => $request->Departement,
            'Grade' => $request->Grade,
            'isAdmin' => false
         
           ]); 
           session()->flush('success','admin  creer avec success');



        

        return redirect('/users');
    }
    
    public function edit($id){
        
        $DepartmentRef = $this->db->collection('Departments');
        $snapshot = $DepartmentRef->documents();
        $departement = $snapshot;   
       // print_r($user);  
        // return view ('emails.create', compact('departement'));
        $docRef = $this->db->collection('users')->document($id);
        //$query = $docRef->where('id', '=', $id);
        $snapshot = $docRef->snapshot();
        $user = $snapshot;
        // with('entries',$entry)->with('random',$random);
        return view('user.edit')->with('user',$user)->with('departement',$departement);
    }

    public function update($id, Request $Request){

        if (empty($Request['Email']) && empty($Request['password']) ) {
  
            $docRef = $this->db->collection('users')->document($id)
            ->update([
                ['path' => 'FullName', 'value' => $Request->FullName],
                ['path' => 'Departement', 'value' => $Request->Departement],
                ['path' => 'Grade', 'value' => $Request->Grade],
                
                
                ]);

        } if (!empty($Request['Email']) && !empty($Request['password']) && !empty($Request['password_confirmation'])) {
           
            $updatePassword =$this->auth->changeUserPassword($id, $Request['passwod']);
            $updatedUser = $this->auth->changeUserEmail($id, $Request['Email']);
            $docRef = $this->db->collection('users')->document($id)
            ->update([
                ['path' => 'FullName', 'value' => $Request->FullName],
                ['path' => 'Departement', 'value' => $Request->Departement],
                ['path' => 'Grade', 'value' => $Request->Grade],
                ]);
        }if (!empty($Request['Email']) && empty($Request['password']) ) {
            $updatedUser = $this->auth->changeUserEmail($id, $Request['Email']);
            $docRef = $this->db->collection('users')->document($id)
            ->update([
                ['path' => 'FullName', 'value' => $Request->FullName],
                ['path' => 'Departement', 'value' => $Request->Departement],
                ['path' => 'Grade', 'value' => $Request->Grade],
                ]);
        }if (empty($Request['Email']) && !empty($Request['password']) ) {
            $updatePassword =$this->auth->changeUserPassword($id, $Request['passwod']);
            $docRef = $this->db->collection('users')->document($id)
            ->update([
                ['path' => 'FullName', 'value' => $Request->FullName],
                ['path' => 'Departement', 'value' => $Request->Departement],
                ['path' => 'Grade', 'value' => $Request->Grade],
                ]);
        }


    
        return redirect('/users');
    }
    
    public function destroy($id){
        $this->auth->deleteUser($id);
        $docRef = $this->db->collection('users')->document($id)->delete();
       
        return redirect('/logout');
    }
}
