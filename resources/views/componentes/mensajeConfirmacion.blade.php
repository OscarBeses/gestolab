@if ($message = Session::get('confirmacion'))
    <div class="row">
        <div class="alert alert-success w-100">
            <p>{{ $message }}</p>
        </div>
    </div>
@endif
@if ($messageErr = Session::get('error'))
    <div class="row">
        <div class="alert alert-danger w-100">
            <p>{{ $messageErr }}</p>
        </div>
    </div>
@endif