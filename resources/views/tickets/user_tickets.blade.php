@extends('layouts.app')

@section('title', 'My Tickets')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-ticket">My Tickets</i>
                </div>

                <div class="panel-body">
                    @if($tickets->isEmpty())
                        <p>You have not created any Tickets</p>}
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Category</td>
                                    <td>Tittle</td>
                                    <td>Status</td>
                                    <td>Last Updated</td>
                                </tr>
                            </thead>
                            <tbod>
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td>
                                            @foreach($categories as $category)
                                                @if($category->id === $ticket->category_id)
                                                    {{ $category->name  }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ url('tickets/'.$ticket->ticket_id)  }}">
                                                {{ $ticket->ticket_id }} - {{ $ticket->title }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($ticket->status === 'Open')
                                                <span class="label label-success">{{ $ticket->status  }}</span>
                                            @else
                                                <span class="label label-danger">{{ $ticket->status  }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $ticket->updated_at }}</td>
                                    </tr>
                                @endforeach
                            </tbod>
                        </table>
                        {{ $tickets->render() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection