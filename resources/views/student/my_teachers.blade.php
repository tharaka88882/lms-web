@extends('layouts.app')

@section('title')
    Conversations | YOU2MENTOR
@endsection

@push('styles')
    {{-- <style>h1 {background-color: red !important}</style> --}}
@endpush

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              {{-- <h1>YOU2MENTOR</h1> --}}
            </div>
            {{-- <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Conversations</li>
              </ol>
            </div> --}}
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Mentor conversations List</h3>
          </div>
          <!-- <div class="card-body">
              <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            {{-- <th>Email</th>
                            <th>Status</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($conversations as $conversation)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$conversation->teacher->user->name}}</td>
                            {{-- <td>{{$conversation->teacher->user->email}}</td>
                            <td><h5><span class="badge badge-secondary">{{$conversation->teacher->status==('1')? 'Active':'Inactive'}}</span><h5></td> --}}
                            <td>
                              <a class="btn btn-sm btn-warning" href="{{route('student.view_conversation', $conversation->id)}}"><i class="far fa-edit"></i> View Conversation</a>
                          </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>

              </div>
          </div> -->

          <div class="card-body">
          <div class="row">
                                @foreach ($conversations as $conversation)
                                    <div class="col-md-6">
                                        <div class="card p-2">
                                            <div class="d-flex align-items-center">
                                                <a href="#">
                                                    <img @if ($conversation->teacher->user->image != null) src="{{ url('public') }}/images/profile/{{ $conversation->teacher->user->image}}" @else src="" @endif alt="User Image" style="width: 120px; height: 120px; border-radius: 50%;" onerror=" this.src='{{ url('public') }}/images/def.jpg'">
                                                </a>
                                                <div class="ml-3 w-100">
                                                    <h4 class="mb-0 mt-0"><a style="text-transform: capitalize" href="{{ route('student.view_tutor', $conversation->teacher->user->id) }}">{{ $conversation->teacher->user->name}}</a></h4>

                                                    @php
                                                    $mediation = 0;
                                                    $rator_count = count(json_decode($conversation->teacher->rate,true));
                                                    $rating_count = 0;
                                                        $mediation = 0;
                                                    @endphp
                                                    @foreach ($conversation->teacher->rate as $rating1)
                                                    @php
                                                    $rating_count+=$rating1->rating;
                                                    @endphp



                                                    @if($rator_count!=0)
                                                       @php
                                                            $mediation = $rating_count/$rator_count;
                                                       @endphp
                                                    @endif

                                                       @php
                                                            $round_mediation =(int)$mediation;
                                                       @endphp



                                                    @endforeach

                                                    @php
                                                        $i = 0;
                                                        //$r = intval(Auth()->user()->userable->level);
                                                        $r = (int)$mediation;
                                                    @endphp
                                                    @while ($i<5)
                                                        @if ($r>0)
                                                        <span class="fa fa-star checked"></span>
                                                        @else
                                                        <span class="fa fa-star"></span>

                                                        @endif
                                                        @php
                                                        $i += 1;
                                                        $r -=1;
                                                        @endphp
                                                    @endwhile

                                                    <div class="p-2 mt-2 bg-light d-flex justify-content-between rounded text-white stats" style="font-size: 14px;">
                                                          @foreach ($conversation->teacher->teachersubject as $skil)
                                                          <span>Skills -
                                                            <span class="badge bg-gray">{{$skil->name}}</span>
                                                        </span>
                                                          @endforeach
                                                        </div>

                                                       @if ( $conversation->teacher->user->country!=null)
                                                       <span class="users-list-date">{{$conversation->teacher->user->country}}/ {{$conversation->teacher->user->city}}</span>
                                                       @endif

                                                    <div class="button mt-2 d-flex flex-row align-items-center">
                                                            <a href="{{ route('student.view_tutor', $conversation->teacher->id) }}">
                                                            <button class="btn btn-sm btn-outline-primary w-100">View Profile</button>
                                                        </a>
                                                            <a href="{{route('student.view_conversation', $conversation->id)}}">
                                                                <button class="btn btn-sm btn-primary w-100 ml-2">Conversation</button>
                                                            </a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            </div>



          <!-- /.card-body -->
          <div class="card-footer">
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->

      </section>
@endsection
