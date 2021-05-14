<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use Kreait\Firebase\Database\Transaction;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        self::$database=self::firebaseDatabaseInstance();
        // Create the Cloud Firestore client               
    }

    public function index()
    {
        $ref = self::$database
        ->getReference('blog/posts');
        $allPost=$ref->getValue();
        
        foreach($allPost as $data){
            $allData[] = $data;
        }

        return json_encode($allData); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ref=self::$database->getReference('blog/posts');
        $newPost=$ref
        ->push([])
        ->getKey();

        $new = $ref
        ->getChild($newPost)->set([
            'body'=>'Programming',
            'title'=>'Realtime app with Cloud Firestore'
        ]);
        return $new->getValue(); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ref=self::$database->getReference('blog/posts');
        $data=$ref->orderByChild('id')->equalTo($id)->getValue;

        return json_encode($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ref=self::$database->getReference('blog/posts/'. $id);
        $data= $ref
        ->update([
            'body' => 'Database',
            'title' => 'Realtime app with cloud Firestore'
        ]);

        return json_encode($data);
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
        //$id='-LmmwDK-mly-1VLedyUx';
        $ref=self::$database->getReference('blog/posts/'. $id);
        $query=$ref->remove();

        return json_encode($query);
    }
}
