@if (session()->has('message'))
    <div class="toast success sg-toast">
    {{ session('message') }}
    </div>

@endif