@if (session()->has('message'))
    <div class="toast success sg-toast">
    {{ session('message') }}
    </div>

@endif

@if (session()->has('popup'))
    <div class="popup ng-show" style="display: block;" ng-hide="popupNewContact">
      <div class="popup-mask">
        <div class="panel">
          <div class="panel-inner">
            <div class="popup-cancel">
              <a href="#" ng-click="popupNewContact=true;"><i class="fa fa-fw fa-times"></i></a>
            </div>
            <div class="edit-events container">
              <h2>You have added {{ session('popup') }} contacts to the event.</h2>

              	@if( session('amount_of_duplicates') > 0 )

	              <h2>Guests already on the guest list and not duplicated:</h2>
	              <ul><!-- Should not hard code the i max-->
	              	@for ($i = 0; $i < session('amount_of_duplicates'); $i++)
	              		<li>{{session($i)}}</li>
	              	@endfor
	              </ul>
	            @else
	            @endif
            </div>
          </div>
        </div>
      </div>
    </div>
@endif
