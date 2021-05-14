<?php

namespace App\Http\Controllers;

use DateTime as GlobalDateTime;
use Faker\Provider\cs_CZ\DateTime;
use Google\Cloud\Core\Compute\Metadata;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use \Kreait\Firebase\Database;
use Google\Cloud\Firestore\FirestoreClient;
use GPBMetadata\Google\Firestore\Admin\V1\Index;
use Google\Cloud\Firestore\DocumentSnapshot;
use Google\Cloud\Core\GeoPoint;
use Google\Cloud\Core\Timestamp;
use Google\Cloud\Storage\StorageClient;
use League\Flysystem\Filesystem;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;
class MailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */




   
    public function index()
    {
        $this->changeStatus();
        $docRef = $this->db->collection('emails');
        $snapshot = $docRef->documents();
        $email = $snapshot;   
       // print_r($user);  
        return view ('emails.index', compact('email'));

    }

    public function changeStatus(){

        $docRef = $this->db->collection('emails');
        $snapshot = $docRef->documents();
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
     
        $docRef = $this->db->collection('emails');
        $snapshot = $docRef->where('Traited','==',$etat)->documents();
        $email = $snapshot;
        return $email;
    }

    public function encours(){
        $this->changeStatus();
       $email=$this->traitedStatus('Still');  
       // print_r($user);  
        return view ('emails.encours', compact('email'));
    }
    public function notTraited(){
        $this->changeStatus();
        $email=$this->traitedStatus('Not Traited');  
        // print_r($user);  
         return view ('emails.notTraited', compact('email'));
     }
     public function Traited(){
        $this->changeStatus();
        $email=$this->traitedStatus('Traited');  
        // print_r($user);  
         return view ('emails.traited', compact('email'));
     }

public function thisme(){
    return view ('emails.file');
}


    public function store2(Request $request)
    {
        $fileArray =array();
        if($request->hasFile('attachment')) {

            $fileArray = $request->file('attachment');

        for ($i=0; $i < sizeof($fileArray); $i++) { 
            $fileName = $fileArray[$i]->extension();
        echo $fileName;
        }
        }
           
       
    }

    function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $docRef = $this->db->collection('Departments');
        $snapshot = $docRef->documents();
        $departement = $snapshot;   
       // print_r($user);  
        return view ('emails.create', compact('departement'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


     
    public function store(Request $request)
    {

        $arryMap = array();
        $filesArray =array();
        $replaymap = array_map(Null,$arryMap);
        $docRef = $this->db->collection('emails')->newDocument();
        $CurentUserId=session('uid');
        $date = new \DateTime();
        $DateRecive = $date->format('Y-m-d H:i:s');
        // $tmpFilePath =array();
        
        

        if($request->hasFile('attachment')) {

            $filesArray = $request->file('attachment');
       
            $filesArray = $this->uploadFileToStorage($request->Departement,$filesArray);
            $docRef->set([      
                'Title' => $request->Title,
                'Body' => $request->Body,
                'Department' => $request->Departement,
                'Delay' => $request->Delay,
                'DateRecive' => $DateRecive,
                'from' => $CurentUserId,
                'Files' => $filesArray,
                'Traited' => 'Still'
                
            ]);

        }else{
            $docRef->set([      
                'Title' => $request->Title,
                'Body' => $request->Body,
                'Department' => $request->Departement,
                'Delay' => $request->Delay,
                'DateRecive' => $DateRecive,
                'from' => $CurentUserId,
                'Files' => $filesArray,
                'Traited' => 'Still'
                

            ]);
        }
       
        
        

        return redirect('/mails');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $docRef = $this->db->collection('emails')->document($id);
        //$query = $docRef->where('id', '=', $id);
        $snapshot = $docRef->snapshot();
        $Email = $snapshot;

        return view('emails.show', compact('Email'));
    }


    public function showreplay($id){
        $docRef = $this->db->collection('emails')->document($id);
        $snapshot = $docRef->snapshot();
        $Email = $snapshot['ReplayMail'];
        
        return view('emails.Replay', compact('Email'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $docRef = $this->db->collection('emails')->document($id)->delete();
        return redirect('/mails');
    }
}
