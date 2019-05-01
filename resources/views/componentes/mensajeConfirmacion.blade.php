<div class="row">
    @if ($message = Session::get('confirmacion'))
        <div class="alert alert-success w-100">
            <p>{{ $message }}</p>
        </div>
    @endif
</div>