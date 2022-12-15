@extends('layouts.app')

@section('content')
    @livewire('cms.order.show', compact('reference'))
@endsection
