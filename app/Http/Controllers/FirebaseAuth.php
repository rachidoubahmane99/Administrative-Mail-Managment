<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirebaseAuth extends Controller
{
    


    public function LoginForm(){
        return view('auth.login');
    }

    public function MyInfo($id){
        // $id= session('uid');
        $docRef = $this->db->collection('users')->document($id);
        //$query = $docRef->where('id', '=', $id);
        $snapshot = $docRef->snapshot();
        $user = $snapshot;
    return $user;
    }

    public function isAdmin($id){
        $docRef =  $this->db->collection('users')->document($id);
        $Account = $docRef->snapshot();
        if($Account->exists() && $Account['isAdmin']==true){
            return true;
        }
        return false;
            }


            public function isUser($id){
                $docRef =  $this->db->collection('users')->document($id);
                $Account = $docRef->snapshot();
                if($Account->exists() && $Account['isAdmin']==false){
                    return true;
                }
                return false;
                    }


    public function Logincheck(Request $request){

        try {
            $logged_user = $this->auth->signInWithEmailAndPassword($request->Email, $request->password);
            if ($logged_user) {
                $User = $this->MyInfo($logged_user->firebaseUserId());
                $FullName=$User['FullName'];
                if ($this->isAdmin($logged_user->firebaseUserId())) {
                    session()->put('uid', $logged_user->firebaseUserId());
                    session()->put('FullName', $FullName);
                    return redirect()->route('users');
                }
                if ($this->isUser($logged_user->firebaseUserId())) {
                    session()->put('uid', $logged_user->firebaseUserId());
                    session()->put('FullName', $FullName);
                    return redirect()->route('user.mails');
                }
                
            }
            // else{
            //     session()->flash('errors', 'Credentials are incorrect');
            //     // session()->put('status', "");
                    
            //     return view('auth.login');
            // }
            
            //Credentials are correct
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword | \Kreait\Firebase\Exception\InvalidArgumentException | \Kreait\Firebase\Auth\SignIn\FailedToSignIn $e) {
            $message = $e->getMessage();
            session()->flash('errors', $message);
            return redirect('login');
        }



    }




    public function RegisterForm(){
        $docRef = $this->db->collection('Departments');
        $snapshot = $docRef->documents();
        $departement = $snapshot;   
     
        return view('auth.register', compact('departement'));
    }

    public function Registercheck(Request $request){
    

if (!empty($request->FullName) && !empty($request->Email) && !empty($request->Departement) && !empty($request->password)) {
    # code...
}
        try {

            $email = $request->Email;
            $password = $request->password;
            $authRef = app('firebase.auth')->createUser([
                 'email' => $email,
                'password' => $password
           ]);
           $user = $this->auth->signInWithEmailAndPassword($email, $password);

           $newuser = $this->db->collection('users')->document($user->firebaseUserId());
            $newuser->set([
            'FullName' => $request->FullName,
            'Departement'  => $request->Departement,
            'Grade'       => 'no definie',
            'isAdmin' => false
            
            ]); 
            session()->flash('status', 'account registred succesfully');
            // session()->put('status', "");
                
            return view('auth.login');
        //   $actionCodeSettings = [
        //            'continueUrl' => 'www.remoteclassroom.com/home'
        //   ];

        //    app('firebase.auth')->sendEmailVerificationLink($email, $actionCodeSettings);

        //    echo $authRef->uid; //This is unique id of inserted user.
    }
    catch (\Kreait\Firebase\Exception\Auth\EmailExists $ex) {
       echo 'email already exists';
    }


    }



    public function logout(){
        Session()->forget('uid');
        Session()->forget('FullName');
        return redirect()->route('login');
        
    }

}
