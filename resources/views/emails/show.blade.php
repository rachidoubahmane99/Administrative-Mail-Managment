@extends('layouts.app')
@section('content')
<section class="content center">
      <div class="row">
        <!-- left column -->
        <div class="col-md-10">
          <!-- general form elements -->
          <div class="box box-primary">
            
            <!-- /.box-header -->
            <!-- form start -->
           <br><br>
<div class="container">
	<div class="row">

                    	<div class=" col-md-6">
                  		<div class="form-group">
                            
                        <label>Titre :</label>
                            <input type="text" class="form-control" name="Title" autocomplete="off" id="title" value="{{ $Email['Title'] }}" readonly="true">
                  		</div>
                  	</div>
    </div>
    <div class="row"> 
                      
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Message :</label>
                                <textarea class="form-control textarea" rows="3" name="Body" id="Message" placeholder="Message" readonly="true">{{ $Email['Body'] }}</textarea>
                        </div>
                    </div>
    </div>
    <div class="row"> 
                      <div class="col-md-6">
                        <div class="form-group">
                      <label>Departement :</label>
                          <input type="text" class="form-control" name="Departement" value="{{ $Email['Department'] }}" autocomplete="off" id="title" readonly="true">
                        </div>
                    </div>
                  

                    <div class="col-sm-2">
                  		<div class="form-group">
                        <label>Duréé :</label>
                         <input type="number" class="form-control" name="Delay" max="60" min="1" value="{{ $Email['Delay'] }}" readonly="true">
                      </div>
                    </div>
    </div>
    <div class="row">
                    <div class="col-sm-2 left">
                        <div class="form-group">
                            <label>Date :</label>
                            <span>{{ Carbon\Carbon::parse(substr($Email['DateRecive'],0,19))->diffForHumans()}}</span>
                    </div>
                  </div>
    </div>
                  <div class="row">
                    <div class="col-sm-6 left">
                        <label>Attachment :</label>
                @foreach($Email['Files'] as $file)
                    <a href="{{$file}}" class="btn btn-sm btn-warning">download</a>
                @endforeach
                    </div>
                  </div>
                  <br>
                  @if(!empty($Email['ReplayMail']) && count($Email['ReplayMail'])>1 )
                      
                 
                  <div class="col-md-2">
                    <a href="/emails/replay/{{ $Email->id() }}" class="btn btn-success ">
                         Show Replay
                      </a>
                  <br> <br> 
                </div>
                  
    
                @endif
                      <div class="col-md-4">
                        <a href="/emails/delete/{{ $Email->id() }}" class="btn btn-danger ">
                             Supprimer Email
                          </a>
                      <br> <br> 
                    </div>
                  	
      
               
	
</div>

        </div>
        <!--/.col (right) -->
      </div>
    </div>
      <!-- /.row -->
    </section>
@endsection            