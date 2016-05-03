@extends('layouts.app')
@section('content')
<div class="form container">
    <h1>Create Contact</h1>

    {!! Form::open(['url' => 'contacts', 'class' => 'form', 'novalidate' => 'novalidate', 'files' => true]) !!}

        @include('contactFolder._contactForm', ['submitButtonText' => 'Create Contact'])

    {!! Form::close() !!}

    @include('errors._list')
</div>

<div ng-app="">
	<div class="sg-spacer-xx-lg">
		<button type="button" name="button" class="button-default" ng-click="popup1=true">Popup with Confirmation</button>
		<div class="popup ng-hide" style="display: block;" ng-show="popup1">
			<div class="popup-mask">
				<div class="panel">
					<div class="panel-inner">
						<div class="popup-cancel">
							<a href="#" ng-click="popup1=false;"><i class="fa fa-fw fa-times"></i></a>
						</div>
						<h2>Thank you for your feedback!</h2>
						<p>
							You’ll be the first to know once the new update arrives. How exciting!
						</p>
						<p class="popup-button">
							<button type="button" name="button" class="button-primary" ng-click="popup1=false;">Cool. Take me back to home page</button>
						</p>
					</div>
				</div>
			</div>
		</div>

		<button type="button" name="button" class="button-default" ng-click="popup2 = true;">Popup without Close</button>
		<div class="popup ng-hide" style="display: block;" ng-show="popup2">
			<div class="popup-mask">
				<div class="panel">
					<div class="panel-inner">
						<h2>Are you sure you want to discard unsaved changes?</h2>
						<p class="popup-button">
							<button type="button" name="button" class="button-primary" ng-click="popup2=false;">No, take me back</button>
						</p>
						<p class="link-cancel">
							<a href="#" ng-click="popup2=false;">Yes, discard changes and leave page</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="/js/jquery.jscroll.js'"></script>



<div class="scroller">
    <ul>
    @foreach($data as $link)
        <li data-url="{{url('link/'.$link->slug)}}">
            <a>
                <img alt="" src="{{$link->preview}}">
                <div><span>{{$link->title}}</span></div>
            </a>
        </li>
    @endforeach
    </ul>
    {{$data->links()}}
</div>
 
<script>
    $(document).ready(function(){
 
        //hides the default paginator
        $('ul.pagination:visible:first').hide();
 
        //init jscroll and tell it a few key configuration details
        //nextSelector - this will look for the automatically created {{$data->links()}}
        //contentSelector - this is the element wrapper which is cloned and appended with new paginated data
        $('div.scroller').jscroll({
            debug: true,
            autoTrigger: true,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.scroller',
            callback: function() {
 
                //again hide the paginator from view
                $('ul.pagination:visible:first').hide();
 
            }
        });
    });
</script>
@endsection