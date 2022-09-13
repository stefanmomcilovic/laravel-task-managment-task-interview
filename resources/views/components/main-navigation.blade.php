<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link @if(Route::current()->getName() == 'home') active @endif" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if(Route::current()->getName() == 'task.add') active @endif" href="{{ url('/task/add') }}">Add task</a>
        </li>
      </ul>
    </div>
  </div>
</nav>