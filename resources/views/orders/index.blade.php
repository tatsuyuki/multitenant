@extends('layouts.app')

@section('content')
<div>Orders</div>

<ul>
    @foreach($orders as $order)
        <li><a href="/orders/{{ $order->id }}">{{ $order->id }}</a></li>
    @endforeach
</ul>

@endsection