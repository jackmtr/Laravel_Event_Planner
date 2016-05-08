@extends('layouts.app')
@section('content')
<div class="form container">
    <h1>Create Contact</h1>

    {!! Form::open(['url' => 'contacts', 'class' => 'form', 'novalidate' => 'novalidate', 'files' => true]) !!}

        @include('contactFolder._contactForm', ['submitButtonText' => 'Create Contact', 'edit' => false])

    {!! Form::close() !!}

    @include('errors._list')
</div>
@endsection

@section('javascript')
	<script>
		$(document).ready(function(){

			var max_fields = 10; //maximum input boxes allowed
			var index = {{$phoneindex}};			

			$('.cellcheckbox').on('click', 'span', function(){
				var checkbox = $(this).parent().find("input");
				checkbox.prop("checked", !checkbox.prop("checked"));
			});

			$(".add_phone").click(function(e){
				if(index < max_fields)
				{
				  $(".new-phone-numbers").append("<div class='form-group'><label for='phone_number" + index +"'>Additional Phone Number: </label><input class='form-control' name='phonegroup[]" + index +"' type='text' value='' id='phone_number" + index + "'><a href='#' class='remove_field'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></div>");
				  index++;
				}

			});

			$(".delete-phone-numbers", $(this)).on("click",".remove_field", function(e){ //user click on remove text
				e.preventDefault(); $(this).parent('div').remove(); index--;
			}); //end of remove field			

		});
	</script>
@endsection