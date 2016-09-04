<?php

namespace App\Http\Controllers;

use App\Mailers\AppMailer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Category;

class TicketsController extends Controller
{
    /**
     * Action create
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();

        return view('tickets.create', compact('categories'));
    }

    /**
     * Action store, to store a ticket on the DB
     *
     * @param Request $request
     * @param AppMailer $mailer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, AppMailer $mailer)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'priority' => 'required',
            'message' => 'required'
        ]);

        $ticket = new Ticket([
            'title' => $request->input('title'),
            'user_id' => Auth::user()->id,
            'ticket_id' => strtoupper(str_random(10)),
            'category_id' => $request->input('category'),
            'priority' => $request->input('priority'),
            'message' => $request->input('message'),
            'status' => 'Open'
        ]);

        $ticket->save();

        $mailer->sendTicketInformation(Auth::user(), $ticket);

        return redirect()->back()->with('status', "A ticket with ID: #$ticket->ticket_id has been opened.");
    }

    /**
     * Action to show the current user's tickets
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userTickets()
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->paginate(10);
        $categories = Category::all();

        return view('tickets.user_tickets', compact('tickets', 'categories'));
    }

    /**
     * Action to show just one ticket by id
     *
     * @param $ticket_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

        $comments = $ticket->comments;

        $category = $ticket->category;

        return view('tickets.show', compact('ticket', 'category', 'comments'));
    }

}
