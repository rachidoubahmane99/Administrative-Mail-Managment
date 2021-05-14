<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */




    public function index()
    {
        $docRef = $this->db->collection('Departments');
        $snapshot = $docRef->documents();
        $departement = $snapshot;   
       // print_r($user);  
        return view ('Departements.index', compact('departement'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Departements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $docRef = $this->db->collection('Departments')->newDocument();
        $docRef->set([    
            'DepartName' => $request->DepartName
          ]);
       

        return redirect('/departements');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $docRef = $this->db->collection('Departments')->document($id);
        //$query = $docRef->where('id', '=', $id);
        $snapshot = $docRef->snapshot();
        $departement = $snapshot;

        return view('Departements.edit', compact('departement'));
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
        $docRef = $this->db->collection('Departments')->document($id)
        ->update([
            ['path' => 'DepartName', 'value' =>  $request->DepartName]
           ]);
       
        return redirect('/departements');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $docRef = $this->db->collection('Departments')->document($id);
        $docRef->delete();

        return redirect('/departements');
    }
}
