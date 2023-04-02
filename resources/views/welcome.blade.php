@auth
  @includeWhen(Auth::user()->type == 'admin','interfaces.admin', ['user.type' => 'admin'])
  @includeWhen(Auth::user()->type == 'user','interfaces.user', ['user.type' => 'user'])
@endauth
@guest
  @include('interfaces.guest')
@endguest
