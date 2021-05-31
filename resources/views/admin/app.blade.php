  <title>@yield('title') - {{ config('app.name') }}</title>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <meta name="csrf-token" content="{{ csrf_token() }}">


  </head>

  <body class="app sidebar-mini rtl">
      @include('admin.partials.header')
      @include('admin.partials.sidebar')
      <main class="app-content" id="app">
          @yield('content')
      </main>
      <script src="{{ URL::asset('../../../../backend/js/jquery-3.2.1.min.js') }}"></script>
      <script src="{{ URL::asset('../../../../backend/js/popper.min.js') }}"></script>
      <script src="{{ URL::asset('../../../../backend/js/bootstrap.min.js') }}"></script>
      <script src="{{ URL::asset('../../../../backend/js/main.js') }}"></script>
      <script src="{{ URL::asset('../../../../backend/js/plugins/pace.min.js') }}"></script>
      @stack('scripts')
  </body>

  </html>
