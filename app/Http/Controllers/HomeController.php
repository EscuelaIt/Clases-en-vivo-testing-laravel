<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $messages = Message::all();
        return view('home')->with([
            'messages' => $messages,
        ]);
    }
}
