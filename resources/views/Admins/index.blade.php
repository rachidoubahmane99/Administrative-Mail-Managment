@extends('layouts.app')

@section('content')

<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listes d'Adminsitrateur</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <a class="btn btn-primary" href="/admins/create">Ajouter  Nouveau  Administrateur</a>
            <hr>            
           @if(session()->has('success'))
    <div class="alert alert-success">
        <ul>
            
                <li>{{ $session()->get('success') }}</li>
           
        </ul>
    
@endif
              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
              <div class="row"><div class="col-sm-12">
              <table id="example1" class="table table-bordered table-striped dataTable" 
                role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 182px;">Nom Complet</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 156px;">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($admins as $data)
                
                <tr role="row" class="odd">
                  
                  @if ($data['isAdmin']== true )
                  <td class="sorting_1">{{ $data['FullName'] }}</td>
                  
                  <td>
                    <a class="btn btn-xs btn-warning"  href="/admins/edit/{{ $data->id() }}">Edit</a>
  
                    <a class="btn btn-xs btn-danger" href="/admins/delete/{{ $data->id() }}">Delete</a>
                  </td>
                  @endif
                 
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                </tfoot>
              </table>
              <div class="modal modal-warning fade" id="modal-warning">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title">Warning Modal</h4>
                    </div>
                    <div class="modal-body">
                      <p>One fine body…</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-outline">Save changes</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
@endsection
