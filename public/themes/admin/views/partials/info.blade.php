@if(Session::has('info'))
<div class="callout callout-info">
	<h4>{{ Lang::get('Information') }}</h4>
	<p>{{ Session::get('info') }}</p>
</div>
@endif