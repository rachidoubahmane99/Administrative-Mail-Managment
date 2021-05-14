@extends('layouts.app')
@section('content')
<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route('admins.store') }}" method="post">
            {{ csrf_field() }}
              <div class="box-body">
              <div class="form-group">
                  <label for="FullName">FullName</label>
                  <input type="text" class="form-control" name="FullName" required="required" placeholder="Enter FullName">
              </div> 
              <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="Email" required="required" placeholder="name@example.com">
              </div>
              <div class="form-group">
                    <label for="exampleInputPassword1">Mot de pass</label>
                    <input type="password" class="form-control" name="password" required="required" placeholder="">
                </div>
                
                <div class="form-group">
                  <label for="password_confirmation">Confirmer mot de pass</label>
                  <input type="password" class="form-control" name="password_confirmation" required="required" placeholder="">
                </div>
                          
              
                </div>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer align-center">
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