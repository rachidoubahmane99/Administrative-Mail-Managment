@extends('layouts.app')
@section('content')
<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modifier le Departement </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/departements/update/{{ $departement->id() }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
              <div class="box-body">
              <div class="form-group">
                  <label for="exampleInputEmail1">Nom De Departement</label>
                  <input type="text" class="form-control" name="DepartName" required="required" placeholder="Enter nom de Departement" value="{{ $departement['DepartName'] }}">
                </div>              
                
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Mise A jour</button>
              </div>
            </form>
          </div>
        </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
@endsection            