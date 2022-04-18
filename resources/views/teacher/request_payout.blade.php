@extends('layouts.app')

@section('title')
    Request Payout
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
                <li class="breadcrumb-item active">Request Payout</li>
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
        <h3 class="card-title">Request Payout</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('teacher.request_payout')}}" method="POST">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="SubjectName">Your Paypal Email*</label>
                 <input type="email" value="{{Auth()->user()->email}}" name="paypal_email"  class="form-control  @if($errors->has('paypal_email')) {{'is-invalid'}} @endif"  for="SubjectName"/>
                      @if($errors->has('paypal_email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('paypal_email') }}</strong>
                        </span>
                    @endif

                </div>
                <div class="form-group">
                    <label for="SubjectName">Available Balance</label>
                    <label disabled="" class="form-control" for="SubjectName">${{Auth()->user()->userable->amount}}</label>


                </div>
                <div class="form-group">
                    <label for="SubjectName">Minimum Payout</label>
                    <label disabled="" class="form-control" for="SubjectName">${{$setting->payout_limit}}</label>

                </div>
                <div class="form-group">
                    <label for="SubjectName">Payout Amount*</label>
                    <input type="text" name="payout_amount"  class="form-control  @if($errors->has('payout_amount')) {{'is-invalid'}} @endif"  for="SubjectName"/>
                      @if($errors->has('payout_amount'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('payout_amount') }}</strong>
                        </span>
                    @endif
                </div>
                    <div class="callout callout-info">
                        {{-- <h5>Follow the Instrctions</h5> --}}

                        <p><strong>Request</strong> button will enable when your Available Balance is more than the
                            Minimum Payout.
                        </p>
                    </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button {{(Auth()->user()->userable->amount>=$setting->payout_limit)?"":"disabled"}} type="submit" class="btn btn-success pull-right">Request</button>
            </div>
        </form>
    </div>
  </div>
  <!-- /.card -->
  </section>
@endsection
