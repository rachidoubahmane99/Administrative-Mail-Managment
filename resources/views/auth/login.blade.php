@extends('layouts.auth')

@section('contentAuth')

<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
      <div class="card bg-secondary shadow border-0">
        <div class="card-header bg-transparent pb-5">
          
        <div class="card-body px-lg-5 py-lg-5">
          <div class="text-center  mb-4">
            <strong>Login</strong>
            @if (session('status'))
            <div class="alert alert-success border-left-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('errors'))
        <div class="alert alert-success border-left-warning" role="alert">
            {{ session('errors') }}
        </div>
    @endif
          </div>
          <form role="form" method="POST" action="{{ route('login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                </div>
                <input class="form-control" placeholder="Email" required="required" type="email" name="Email">
              </div>
            </div>
            
            <div class="form-group">
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input class="form-control" placeholder="Mot de passe" required="required" type="password" name="password">
              </div>
            </div> 
            <div class="text-center">
              <button type="submit" class="btn btn-primary mt-4"><strong>Login</strong>  </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection