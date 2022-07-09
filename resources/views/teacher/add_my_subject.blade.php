@extends('layouts.app')

@section('title')
    Add My Skills
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
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item active">Add My  Mentoring Topics </li>
          </ol>
        </div> --}}
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content" >
  <!-- general form elements -->

<div class="col-sm-6">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Add My Skills</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('teacher.stor_subject')}}" method="POST">
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Skills</label>
          {{-- <select class="form-control" name="subject_id">
              @foreach ($subjects as $subject)
              <option value="{{$subject->id}}">{{$subject->name}}</option>
              @endforeach


          </select> --}}
            <select id="select2-echannel-doctor" style="width: 100% !important;padding: 12px 20px !important;margin: 8px 0 !important;display: inline-block !important;border: 1px solid #ccc !important;box-sizing: border-box !important;" name="subject" class="select2 @if($errors->has('subject')) {{'is-invalid'}} @endif" >

            </select>
            @if($errors->has('subject'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('subject') }}</strong>
                        </span>
             @endif
        </div>

      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-success pull-right">Add</button>
      </div>
    </form>
  </div>
</div>
  <!-- /.card -->
  </section>
@endsection

@push('scripts')
  <script>
       $(function () {
   //Initialize Select2 Elements
        // $('.select2').select2({
        //     dropdownParent: $('#currentModal')
        // });

        $('#select2-echannel-doctor').select2({
            ajax: {
                method: 'GET',
                url: '{{route('teacher.get_topics')}}',
                contentType: "application/json; charset=utf-8",
                dataType: 'json',
                data: function (params) {
                    var query = {
                        search: params.term,
                        _method: "GET",
                       // _token: "{{csrf_token()}}",
                        type: 'public'
                    };
                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.results
                    };
                }
            },
           // dropdownParent: $('#currentModal')
        });
    });
  </script>
@endpush
