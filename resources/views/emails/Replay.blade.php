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
                            <input type="text" class="form-control" name="Title" autocomplete="off" id="title" value="{{ $Email['Title']}} " readonly="true">
                  		</div>
                  	</div>
        </div>
    <div class="row"> 
                      
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Message :</label>
                                <textarea class="form-control textarea" rows="3" name="Body" id="Message" placeholder="Message" readonly="true">{{ $Email['Body']}} </textarea>
                        </div>
                    </div>
    </div>
    <div class="row">
        <div class="col-sm-2 left">
            <div class="form-group">
                <label>Date Replay :</label>
                <span>{{ Carbon\Carbon::parse(substr($Email['replayDate'],0,19))->diffForHumans()}}</span>
        </div>
      </div>
</div>

               @if($Email['Files']) 
                  <div class="row">
                    <div class="col-sm-6 left">
                        <label>Attachment :</label>
                @foreach( $Email['Files'] as $file)
                    <a href="{{$file}}" class="btn btn-sm btn-warning">download</a>
                @endforeach
                    </div>
                  </div>
                  <br>
                  @endif
     
               
      
               
	
</div>

        </div>
        <!--/.col (right) -->
      </div>
    </div>
      <!-- /.row -->
    </section>
@endsection            