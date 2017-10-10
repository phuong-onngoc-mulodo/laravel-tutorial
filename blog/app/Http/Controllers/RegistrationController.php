<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
// use App\User;
// use App\Mail\Welcome;
use App\Http\Requests\RegistrationForm;

class RegistrationController extends Controller
{
  public function create()
  {
    return view('registration.create');
  }
  public function store(RegistrationForm $form)
  {
    //Validate the form
    // $this->validate(request(), [
    //   'name' => 'required',
    //   'email' => 'required|email',
    //   'password' => 'required|confirmed'
    // ]);

    //Create and save the user
    // $user = User::create([
    //   'name' => request('name'),
    //   'email' => request('email'),
    //   'password' => bcrypt(request('password'))
    // ]);
    // //Sign then in
    // auth()->login($user);
    //
    // \Mail::to($user)->send(new Welcome($user));

    $form->persist();

    session()->flash('message', 'Thanks so much for signing up!');

    //Redirect to the home page
    return redirect()->home();
  }

}
