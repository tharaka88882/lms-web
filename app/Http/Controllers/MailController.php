<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignUp;
use Brian2694\Toastr\Facades\Toastr;


class MailController extends Controller {
   public function sendMail(){

        Mail::to('dilkikalpana123@gmail.com')->send(new SignUp());

        Toastr::success('sent:)', 'Success');

       // return redirect()->route('home');
        // return view('welcome');
   }
}
