@extends('layouts.app')

@section('title')
    Transaction Summery | YOU2MENTOR
@endsection

@push('styles')
    {{-- <style>h1 {background-color: red !important}</style> --}}
@endpush

@section('content')

<div class="row p-2">
<div class="col-md-6">
 <!-- Default box -->
      <div class="card">
        <div class="card-header">
          {{-- <h3 class="card-title">Title</h3> --}}

          <div class="card-tools">

          </div>
        </div>
        <div class="card-body">
        @if(\Session::has('error'))

               <div class="alert alert-danger alert-dismissible">
                {{-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> --}}
                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                {{ \Session::get('error') }}
              </div>
              {{ \Session::forget('error') }}

        {{-- <div class="alert alert-danger">{{ \Session::get('error') }}</div>
        {{ \Session::forget('error') }} --}}
    @endif

    @if(\Session::has('success'))

    <div class="alert alert-success alert-dismissible">
        {{-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> --}}
        <h5><i class="icon fas fa-check"></i> Success!</h5>
        {{ \Session::get('success') }}
      </div>
      {{ \Session::forget('success') }}
        {{-- <div class="alert alert-success">{{ \Session::get('success') }}</div>
        {{ \Session::forget('success') }} --}}
    @endif

        </div>

      </div>
      <!-- /.card -->
</div>

</div>
@endsection
