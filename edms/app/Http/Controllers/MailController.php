<?php

namespace App\Http\Controllers;
use App\Mail\SignupEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Roles;

class MailController extends Controller
{
    // public static function sendSignupEmail($name, $email) {
    //     $data = [
    //         'firstname' => $name,
           
    //     ];
    //     Mail::to($email)->send(new SignupEmail($data));
    // }
    public function hai() {
        $data = Roles::all();

        Mail::send('jk', $data->toArray(),
        function($message){
            $message->to('jkjtou0@gmail.com', 'Jk')->subject('Hai Jithin');
        });
    }

}
