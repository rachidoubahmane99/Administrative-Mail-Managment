@extends('layouts.Userapp')
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
		<form role="form" id="contact-form" class="contact-form" action="/user/emails/replay/store" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
                <div class="row ">
                    <div class="col-md-6">
                  		<div class="form-group">
                        <label>Titre :</label>
                      <input type="hidden" class="form-control" name="id" autocomplete="off" id="title" placeholder="Titre "  value="{{ $userId}}" >
                      <input type="text" class="form-control" name="Title" autocomplete="off" id="title" placeholder="Titre " >
                  		</div>
                  	</div>
                    
                </div>    
                <div class="row ">
                  	<div class="col-md-6">
                       
                  		<div class="form-group">
                        <label>Message :</label>
                            <textarea class="form-control textarea" rows="3" name="Body" id="Message" placeholder="Message"></textarea>
                  		</div>
                    </div>
              </div>
            <div class="row ">
                      <div class="col-md-4 custom-file">
                    <label>Atachment :</label>
                      <input  name="attachment[]" type="file" class="custom-file-input" id="inputGroupFile04"  data-show-upload="false" data-show-caption="false" multiple>
                      </div>
            </div>
<br>
                    <div class="row">
                  	
                      <div class="col-md-6">
                        <button type="submit" class="btn main-btn btn-info pull-center btn-md-6" name="send">Envoyer la Reponse</button>
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