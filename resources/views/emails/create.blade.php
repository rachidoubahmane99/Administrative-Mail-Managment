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
		<form role="form" id="contact-form" class="contact-form" action="/emails/store" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
                    	<div class="col-md-6">
                  		<div class="form-group">
                        <label>Titre :</label>
                            <input type="text" class="form-control" name="Title" autocomplete="off" id="title" placeholder="Titre ">
                  		</div>
                  	</div>
                    
                    <div class="col-md-2">
                  		<div class="form-group">
                        <label>Departement :</label>
                          <select   class="form-control" name="Departement" autocomplete="off" id="Departement" >
                            @foreach($departement as $data)
                            <option>{{$data['DepartName']}}</option>
                            @endforeach
                          </select>  

                  		</div>
                    </div>
                    
                    
                    
                  
                  		<div class="col-md-6">
                       
                  		<div class="form-group">
                        <label>Message :</label>
                            <textarea class="form-control textarea" rows="3" name="Body" id="Message" placeholder="Message"></textarea>
                  		</div>
                  	</div>
                    <div class="row ">
                      <div class="col-md-4 custom-file">
                    <label>Atachment :</label>
                      <input  name="attachment[]" type="file" class="custom-file-input" id="inputGroupFile04"  data-show-upload="false" data-show-caption="false" multiple>
                      </div>
                    </div>

                    <div class="col-sm-4">
                  		<div class="form-group">
                        <label>Duréé :</label>
                         <input type="number" class="form-control" name="Delay" max="60" min="1" value=1>
                      </div>
                      <div class="col-md-6">
                        <button type="submit" class="btn main-btn btn-info pull-center btn-md-6" name="send">Send a message</button>
                      <br> <br> 
                      </div>
                  	</div>
                    
                  <br>
                  <br>
                </form>
	</div>
</div>

        </div>
        <!--/.col (right) -->
      </div>
    </div>
      <!-- /.row -->
    </section>
@endsection            