@extends('layouts.app')
@section('content')
<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Nouvelle departement</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/departements/store" method="post">
            {{ csrf_field() }}
              <div class="box-body">
              <div class="form-group">
                  <label for="exampleInputEmail1">Nom de Deoartement :</label>
                  <input type="text" class="form-control" name="DepartName" required="required" placeholder="Enter Nom de departement">
                </div>              
              
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
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