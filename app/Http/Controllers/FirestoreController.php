<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Firestore\FirestoreClient;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use \Kreait\Firebase\Database;
use GPBMetadata\Google\Firestore\Admin\V1\Index;
class FirestoreController extends Controller
{

  protected static $db;

  protected static function firestoreDatabaseInstance(){
   

    $db = new FirestoreClient([
      'projectId'=> 'lpsfewebmobile'
    ]);

    return $db;
  }

  public function __construct(){
    static::$db = self::firestoreDatabaseInstance();

  }





  public function index2()
  {
      $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/FirebaseKey.json');
      $firebase = (new Factory)
      ->withServiceAccount($serviceAccount);

      $firestore = new FirestoreClient([
          'projectId' => 'lpsfewebmobile',
      ]);
      
      
return $firestore;

  }



  public function getDocument(){
       
    $collectionReference = $this->index2()->collection('users');

$documentReference = $collectionReference->document('EPbxAvV46j4wAF5R6oVJ');
    $snapshot = $documentReference->snapshot();
    if($snapshot->exists()) {
        printf('Document data:' . PHP_EOL);
        print_r($snapshot->data());

    }else{
      echo 'no data found';
    }
}



  public function index(){
    
    $docRef = self::$db->collection('users');
    $snapshot = $docRef->documents();
     foreach ($snapshot as $user) {
       printf('User: %s' . PHP_EOL, $user->id());
       printf('Departement: %s' . PHP_EOL, $user['Departement']);
       printf('FullName: %s' . PHP_EOL, $user['FullName']);
       printf('isAdmin: %s' . PHP_EOL, $user['isAdmin']);
       printf(PHP_EOL);
   }

   // return json_encode($user);
  }

 
  
  public function create(){
    $docRef = self::$db->collection('users');
    $docRef->add([      
        'nama' => 'ali',
        'email' => 'alibaba@gmail.com',
        'pass' => '12345'
    ]);
    printf('Added data to the lovelace document in the users collection.' . PHP_EOL);
    return json_encode ($docRef);
  }

  public function edit($id){
    //$id = '4Ee3sRyEaoMSJc9XCHfr';
    $docRef = self::$db->collection('users')->document($id);
    $docRef->set([
      'nama' => 'aul',
      'email' => 'aul@gmail.com',
      'pass' => '123458287'
    ]);
    printf('Edit data to the aturing document in the users collection.' . PHP_EOL);
  }

  public function destroy($id){

    $docRef = self::$db->collection('users')->document($id);
    $docRef->delete();
    printf('Delete data to the aturing document in the users collection.' . PHP_EOL);
  }

  public function show(){
    $docRef = self::$db->collection('users');
    $query = $docRef->where('nama', '=', 'ali');
    $documents = $query->documents();

    return dd ($documents);
  }

}
