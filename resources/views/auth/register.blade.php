@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <div id="pswd_info">
                                    <h4>Your passwork must contains :</h4>
                                    <ul>
                                    <li id="letter" class="invalid">
                                        At least <strong>a letter</strong>
                                    </li>
                                    <li id="capital" class="invalid">
                                        At least <strong>a capital letter</strong>
                                    </li>
                                    <li id="number" class="invalid">
                                        At least <strong>a number</strong>
                                    </li>
                                    <li id="length" class="invalid">
                                        At least <strong>8 caracters</strong>
                                    </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script
      type="text/javascript"
      src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"
    ></script>
<script>
    $(function() {
  // Apply a display block to #pswd_info on focus on password
  $("#password").on("focus", function() {
    $("#pswd_info").css("display", "block");
  });
  //display none to #pswd_info when blur
  $("#password").on("blur", function() {
    $("#pswd_info").css("display", "none");
  });
    // on every key pressed
  $("#password").on("keyup", checkAllCases);
  function checkAllCases() {
    // Gathering : checked the password value
    const thePass = $("#pswd").val();
    // this refere to the element that trigger the event
    console.log(thePass);

    // Logic
    // length >= 8
    const lengthValid = thePass.length >= 8;
    // at least one letter str.match(/[A-z]/)
    const letterValid = !!thePass.match(/[A-z]/);
    console.log(letterValid);
    // at least one Capital letter str.match(/[A-Z]/)
    const upperValid = thePass.match(/[A-Z]/); //null or smth
    // at least one number str.match(/\d/)
    const numberValid = thePass.match(/\d/);

    //display *4
    displayValid("#letter", letterValid);
    displayValid("#length", lengthValid);
    displayValid("#capital", upperValid);
    displayValid("#number", numberValid);
  }
}); //LAST DO NOT DELETE
</script>

