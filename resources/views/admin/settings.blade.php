@extends('layouts.app')

@section('title')
    Settings | YOU2MENTOR
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
            <li class="breadcrumb-item active">Settings</li>
          </ol>
        </div> --}}
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
  <!-- general form elements -->
  <div class="col-sm-6">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Settings</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('admin.update_settings')}}" method="POST">
        <div class="card-body">
            @csrf
            @method('PUT')
            {{-- <div class="form-group">
            <label for="CompanyCommission">Company Commission</label>
            <small>( % of commission )</small>
            <input type="text" class="form-control @if($errors->has('commission')) {{'is-invalid'}} @endif" id="exampleInputEmail1" name="commission" placeholder="Company Commission" value="{{$setting->commission}}">
            <input type="hidden" value="commission" name="type">
                    @if($errors->has('commission'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('commission') }}</strong>
                        </span>
                    @endif
            </div> --}}
            <div class="form-group">
                <label for="streamprice">Price of a Stream</label>
                <small>( This [price*stream amount] will be the amount you pay for Mentor )</small>
                <input type="text" class="form-control @if($errors->has('streamprice')) {{'is-invalid'}} @endif" id="exampleInputEmail1" name="streamprice" placeholder="Stream Price" value="{{$setting->streaming_amount}}">
                <input type="hidden" value="streamprice" name="type">
                        @if($errors->has('streamprice'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('streamprice') }}</strong>
                            </span>
                        @endif
                </div>

                        <div class="form-group">
                            <label for="PayoutLimit">Payout Limit</label>
                            <small>( Mentor's can withdraw after this $ limit )</small>
                            <input type="text" class="form-control @if($errors->has('limit')) {{'is-invalid'}} @endif" id="exampleInputEmail1" name="limit" placeholder="Payout Limit" value="{{$setting->payout_limit}}">
                            <input type="hidden" value="limit" name="type">
                                    @if($errors->has('limit'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('limit') }}</strong>
                                        </span>
                                    @endif
                        </div>
                        <div class="form-group">
                            <label for="paidlevel">Paid Level</label>
                            <small>( Mentor's can get the payment after this level )</small>
                            <input type="text" class="form-control @if($errors->has('level')) {{'is-invalid'}} @endif" id="exampleInputEmail1" name="level" placeholder="Paid Level" value="{{$setting->paid_level}}">
                            {{-- <input type="number" value="limit" name="type"> --}}
                                    @if($errors->has('level'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('level') }}</strong>
                                        </span>
                                    @endif
                        </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-success pull-right">Update</button>
        </div>
        </form>
    </div>
  </div>
  <!-- /.card -->
  </section>
@endsection
