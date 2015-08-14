@if ( $errors->count() > 0 )
<div class="callout callout-danger">
    <h4>{{ Lang::get('error.one_or_more') }}</h4>
    <ul>
        @foreach( $errors->all() as $message )
        <li>{{ $message }}</li>
        @endforeach
    </ul>
</div>
@endif