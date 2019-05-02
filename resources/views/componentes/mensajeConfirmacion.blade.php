@if ($message = Session::get('confirmacion'))
    <div class="row">
        <div class="alert alert-success w-100">
            <p>{{ $message }}</p>
        </div>
    </div>
@endif