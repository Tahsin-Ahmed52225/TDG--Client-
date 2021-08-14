
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="TheDevGarden Management Bank.">
  <meta name="author" content="TheDevGarden Dev Team">
  <title>TDG-Client</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset("images/brand/tdg.png") }}" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset("css/nucleo.css") }}" type="text/css">
  <link rel="stylesheet" href="{{ asset("css/FontAwesome/all.min.css") }}" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{ asset("/css/argon.css") }}" type="text/css">
</head>

<body class="bg-default">
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center ">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">TDG Client</h1> <br>

            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center align-items-center">
        <div class="col-lg-8 col-md-8">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4 d-flex flex-column">
                @if ($errors->any())
                     @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}


                        @if ($errors->has('email'))
                        @endif
                        </div>
                    @endforeach
                @endif

                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                @endforeach
                <small>Please fill this info</small>
              </div>
            <form method="POST" action="{{ route('register') }}">
            @csrf
                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                        </div>
                        <input class="form-control" placeholder="Name" type="text"  name="name"  required  autofocus>
                        </div>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                        </div>
                        <input class="form-control" placeholder="Phone" type="text"  name="number"  required  >
                        </div>
                    </div>

                </div>

                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" type="email"  name="email" value="{{ old('email') }}" required  >
                  </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="input-group input-group-merge input-group-alternative">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                          </div>
                          <input id="password" type="password"  placeholder="Password" class="form-control"  name='password' required  >
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="input-group input-group-merge input-group-alternative">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                          </div>
                          <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name='password_confirmation'  required>
                        </div>
                    </div>

                </div>
                <div class="text-center">
                  <button  type="submit" class="btn btn-primary my-4"  style="width:100%;">Register </button>
                </div>
              </form>
                <div class="row ">
                   <div class="col-md-6 d-flex justify-content-start">

                   </div>
                   <div class="col-md-6 d-flex justify-content-end">
                         <a href="{{ route("login") }}" > Already have a account ?   </a>
                   </div>
                </div>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">

                                @if (Route::has('password.request'))
                                     <a class="text-light" href="{{ route('password.request') }}">
                                        <small>Forgot password?</small>
                                     </a>
                                @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset("js/jquery.min.js") }}"></script>
  <script src="{{ asset("js/bootstrap.bundle.min.js") }}"></script>

</body>

</html>

