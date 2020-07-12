@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        <strong>success</strong> {{ session()->get('success') }}
    </div>
@elseif(session()->has('error'))
    <div class="alert alert-danger" role="alert">
        <strong>error</strong> {{ session()->get('error') }}
    </div>
@endif