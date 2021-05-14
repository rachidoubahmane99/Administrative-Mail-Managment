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
            <form action="/users/update/{{ $user->id() }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
              <div class="box-body">
              <div class="form-group">
                  <label for="exampleInputEmail1">FullName</label>
                  <input type="text" class="form-control" name="FullName" required="required" placeholder="Enter FullName" value="{{ $user['FullName'] }}">
                </div> 
                
               
                <div class="form-group ">
                  <label>Departement :</label>
                    <select   class="form-control" name="Departement" autocomplete="off" id="Departement" required="required">
                      <option value="{{ $user['Departement'] }}">{{ $user['Departement'] }}</option>
                      @foreach($departement as $data)
                      <option value="{{ $data['DepartName'] }}">{{$data['DepartName']}}</option>
                      @endforeach
                    </select>  
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Grade</label>
                <input type="text" class="form-control" name="Grade" required="required" placeholder="" value="{{ $user['Grade'] }}">
              </div>
              
              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" name="Email"  placeholder="nouveau email" >
              </div> 
              <div class="form-group">
                <label for="exampleInputEmail1">Mot de pass</label>
                <input type="password" class="form-control" name="password"  placeholder="nouveau mot de pass" >
              </div> 
              <div class="form-group">
                <label for="exampleInputEmail1">Confirmer mot de pass</label>
                <input type="password" class="form-control" name="password_confirmation"  placeholder="confirmer nouveau mot de pass" >
              </div>   
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
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