@if ($errors->any())
	<div class="toast error">
	    <ul>
	        @foreach ($errors->all() as $error)
	            <li>{{ $error }}</li>
	        @endforeach
	    </ul>		
	</div>
@endif   