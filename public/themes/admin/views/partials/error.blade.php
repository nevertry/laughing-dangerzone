@if ( $errors->count() > 0 )
  <ul>
    @foreach( $errors->all() as $message )
      <li>{{ $message }}</li>
    @endforeach
  </ul>
@endif
