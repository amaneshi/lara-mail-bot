@if (session('message', false))
    <div class="alert alert-success">{{ session('message') }}</div>
@endif

