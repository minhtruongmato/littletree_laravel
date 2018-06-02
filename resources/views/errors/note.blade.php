@if(count($errors)>0)
@foreach($errors->all() as $error)
margin<p class="alert alert-danger" style="height: auto; width: 50%; margin:auto;"><i class="glyphicon glyphicon-remove" style="margin-right: 5px;"></i>{{$error}}</p>
 
@endforeach
 
@endif
 
 
 
@if(Session::has('error'))
 
<p class="alert alert-danger" style="height: auto; width: 50%; margin:auto;"><i class="glyphicon glyphicon-remove" style="margin-right: 5px;"></i>{{Session::get('error')}}</p>
 
@endif
 
 
 
@if(Session::has('success'))
 
<p class="alert alert-success" style="height: auto; width: 50%; margin:auto;"><i class="glyphicon glyphicon-ok" style="margin-right: 5px;"></i>{{Session::get('success')}}</p>
 
@endif