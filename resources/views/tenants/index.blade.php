@extends('layouts.app')

@section('content')
<div>Db created</div>

<a class="btn btn-primary" href="/{{$tenant->id}}/orders" role="button">Orders</a>

@endsection