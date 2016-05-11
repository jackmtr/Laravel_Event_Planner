@if (session()->has('message'))
    <div class="alert alert-info">{{ session('message') }}</div>
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
            </div>
          </div>
        </div>
      </div>
    </div>
@endif