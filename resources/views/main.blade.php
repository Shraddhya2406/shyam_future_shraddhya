
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>{{ str_replace('_', ' ', env('APP_NAME')) }}</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    {{-- Sorting css start --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    {{-- Sorting css end --}}

    <!-- Custom styles for this template -->
    @yield('css')
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">{{ str_replace('_', ' ', env('APP_NAME')) }}</a>
  </nav>
  
    <div class="container-fluid">
      <div class="row">
        <main role="main" class="col-md-12 ml-sm-auto col-lg-12 pt-3 px-5">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
              @yield('page-name')
            </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
            </div>
          </div>
  
          {{-- Error message start --}}
          @if (Session::has('error'))
            <div class="alert alert-danger">
              <span> {{ Session::get('error') }} </span>
            </div>
          @endif
          @if (Session::has('success'))
            <div class="alert alert-success">
              <span> {{ Session::get('success') }} </span>
            </div>
          @endif
          @if($errors->any())
            <div class="alert alert-danger">
              @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
              @endforeach
            </div>
          @endif
          {{-- Error message end --}}

          @yield('content')
          
        </main>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    {{-- Validation js start --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
    {{-- Validation js end --}}

    {{-- Sorting js start --}}
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    {{-- Sorting js end --}}

    @yield('script')

  </body>

</html>
