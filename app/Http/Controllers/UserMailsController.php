<?php

namespace App\Http\Controllers;

use Google\Cloud\Firestore\FieldValue;
use Google\Cloud\Firestore\FieldValue\ArrayUnionValue;
use Illuminate\Http\Request;

class UserMailsController extends Controller
{
    

public function Mydepartement(){
    $id= session('uid');
    $docRef = $this->db->collection('users')->document($id);
    //$query = $docRef->where('id', '=', $id);
    $snapshot = $docRef->snapshot();
    $user = $snapshot;
return $user;
}
    public function index()
    {
        $this->changeStatus();
        $user = $this->Mydepartement();
        $departName = $user['Departement'];
        $docRef = $this->db->collection('emails');
        $snapshot = $docRef->where('Department','==',$departName)->documents();
        $email = $snapshot;   
       // print_r($user);  
        return view ('UserMails.index', compact('email'));

    }


    
    public function changeStatus(){
        $user = $this->Mydepartement();
        $departName = $user['Departement'];

        $docRef = $this->db->collection('emails');
        $snapshot = $docRef->where('Department','==',$departName)->documents();
        $email = $snapshot;
        $date = new \DateTime();
        $todayDate = $date->format('Y-m-d H:i:s');
        
      

        // $lastDay = DateTime.parse(f.dateRecive).add((Duration(days: f.delay)));
        // var diffrence = today.difference(lastDay).inMinutes;
        foreach ($email as $em) {
            $date = strtotime(substr($em['DateRecive'],0,19)); 
            $datr= date('Y-m-d H:i:s', $date); 
            
            $lastday= date('Y-m-d H:i:s',strtotime($datr.'+'.$em['Delay'].'days'));
            
          if ($todayDate > $lastday && $em['Traited'] != "Traited" && $em['Traited'] != "Not Traited") {
            $docRef = $this->db->collection('emails')->document($em->id)
            ->update([
                ['path' => 'Traited', 'value' =>  'Not Traited']
               ]);
          }
      
        if ($todayDate > $lastday && empty($em['ReplayMail'])) {
            $docRef = $this->db->collection('emails')->document($em->id())
            ->update([
            ['path' => 'ReplayMail', 'value' =>  [
                'NOTHING' => 'NOTHING',
            ]
            ]
            ]);
        }
    }
    }

    public function traitedStatus($etat){
        $this->changeStatus();
        $docRef = $this->db->collection('emails');
        $snapshot = $docRef->where('Traited','==',$etat)->documents();
        $email = $snapshot;
        return $email;
    }

    public function encours(){
       $email=$this->traitedStatus('Still');  
       // print_r($user);  
        return view ('UserMails.encours', compact('email'));
    }
    public function notTraited(){
        $email=$this->traitedStatus('Not Traited');  
        // print_r($user);  
         return view ('UserMails.notTraited', compact('email'));
     }
     public function Traited(){
        $email=$this->traitedStatus('Traited');  
        // print_r($user);  
         return view ('UserMails.traited', compact('email'));
     }
    

     public function Replay($id){
        
        return view ('UserMails.create')->with('userId',$id);
     }

     public function show($id)
     {
         $docRef = $this->db->collection('emails')->document($id);
         //$query = $docRef->where('id', '=', $id);
         $snapshot = $docRef->snapshot();
         $Email = $snapshot;
 
         return view('UserMails.show', compact('Email'));
     }


     public function showreplay($id){
        $docRef = $this->db->collection('emails')->document($id);
        $snapshot = $docRef->snapshot();
        $Email = $snapshot['ReplayMail'];
        
        return view('UserMails.Replay', compact('Email'));
    }
    public function traiter($id){
        $docRef = $this->db->collection('emails')->document($id);
        
        $docRef->update([
            ['path' => 'Traited', 'value' => 'Traited'],
            ]);
        
            return redirect('/user/mails');

    }


     public function uploadFileToStorage($departement,$files){
        $storage = app('firebase.storage');
        $bucket = $storage->getBucket();
      
     
        $fileArray =[];
        $countfiles = count($files);
        for($i=0;$i<$countfiles;$i++){
           
            $name = $files[$i]->getClientOriginalName();
            $filename =  fopen($files[$i]->getRealPath(), 'r');
             
            // Upload file
            $object = $bucket->upload($filename, [
                'name' => $departement.'/'.$name 
            ]);
            
             $object->update(
                 ['acl' => []],
                  ['predefinedAcl' => 'PUBLICREAD']
             );
             $url ="https://storage.googleapis.com/lpsfewebmobile.appspot.com/".$departement."/".$name;
             $fileArray[$i]=$url;
  
          }

          return $fileArray;
    }

    
     public function store(Request $request)
    {

        $arryMap = array();
        $filesArray =array();
        $replaymap = array_map(Null,$arryMap);
        
        $date = new \DateTime();
        $DateReplay = $date->format('Y-m-d H:i:s');
        // $tmpFilePath =array();
        $docRef = $this->db->collection('emails')->document($request->id);
        
        

        if($request->hasFile('attachment')) {

            $filesArray = $request->file('attachment');
       
            $filesArray = $this->uploadFileToStorage($request->Departement,$filesArray);
            $docRef->update([
                ['path' => 'ReplayMail', 'value' =>  [
                    'Title' => $request->Title,
                    'Body'  => $request->Body,
                    'Files' => $filesArray,
                    'replayDate'    =>$DateReplay,
                ]
                ],
                 ['path' => 'Traited', 'value' => 'Traited' ],
               
               
                ]);

        }else{
            $docRef->update([
                ['path' => 'ReplayMail', 'value' =>  [
                    'Title' => $request->Title,
                    'Body'  => $request->Body,
                    'Files' => $filesArray,
                    'replayDate'    =>$DateReplay,
                ]
                ],
                 ['path' => 'Traited', 'value' => 'Traited' ],
               
               
                ]);
        }
       
        
        

        return redirect('/user/mails');

    }
}
