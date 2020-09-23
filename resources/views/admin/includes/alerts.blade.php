@if($errors->any())

@foreach($errors->all() as $error)
<div class="alert alert-warning mb-3 p-2">
    <p>{{$error}}</p>
</div>
@endforeach
@endif

@if(session('message'))

<div class="alert alert-info mb-3 p-2">
    <p>{{session('message')}}</p>
</div>
@endif

@if(session('error'))

<div class="alert alert-danger mb-3 p-2">
    <p>{{session('error')}}</p>
</div>
@endif

@if(session('info'))

<div class="alert alert-warning mb-3 p-2">
    <p>{{session('info')}}</p>
</div>
@endif