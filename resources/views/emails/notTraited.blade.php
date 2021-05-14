@extends('layouts.app')

@section('content')




<div class="box-body">
    <a class="btn btn-primary" href="/emails/create">Add New Mail</a>
</div>
                    <div class="container">
                        <h3>Inbox Emails Not Traited</h3>
                       
                    </div>
                    
                  <aside class="lg-side">
                   
                         <br>
                          <table class="table table-inbox table-hover center" role="grid" aria-describedby="example1_info">
                            <tbody>
                                @foreach($email as $data)
            
                                <tr class="unread">
                                  @if (!empty($data['Title']) and !empty($data['Body']) )
                              
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox">
                                  </td>
                                  <td class="inbox-small-cells">
                                      
                                    @if (!empty($data['ReplayMail']) && count($data['ReplayMail'])>1 )
                                    <i style="color:#FFDF00" class="fa fa-star"></i>
                                    @else
                                    <i  class="fa fa-star"></i>
                                    @endif
                                    </td>
                                <td class="view-message  dont-show sorting_asc">   <span class="label label-danger ">   {{$data['Department']}}</span><a href="/emails/show/{{ $data->id() }}" style="color: inherit;">  {{substr($data['Title'],0,20)}}  </a><span class="label label-success pull-right">{{$data['Traited']}}</span> </td>
                                  <td class="view-message sorting  ">{{substr($data['Body'],0,40)}}</td>
                                  <td class="view-message  inbox-small-cells sorting" width="5px">
                                  @if (!empty($data['Files']))
                                  <i class="fa fa-paperclip"></i>
                                  @endif
                                  </td>
                               
                                  
                                  <td class="view-message  text-right">{{ Carbon\Carbon::parse(substr($data['DateRecive'],0,19))->diffForHumans()}}</td>
                                  @endif
                              </tr>
                              
                            @endforeach
                             
                              
                          </tbody>
                          </table>
                      </div>
                  </aside>
              
            



@endsection
