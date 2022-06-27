<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Brian2694\Toastr\Facades\Toastr;


class MailController extends Controller {
   public function sendMail(){

      $username = 'Dinesh';
        Mail::to('gaveenwick@gmail.com')->send(new WelcomeMail($username));

        Toastr::success('sent', 'Success');

       // return redirect()->route('home');
        // return view('welcome');
   }
}
