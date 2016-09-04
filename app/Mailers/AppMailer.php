<?php
/**
 * Created by PhpStorm.
 * User: buira
 * Date: 03/09/2016
 * Time: 04:40 PM
 */

namespace App\Mailers;


use Illuminate\Contracts\Mail\Mailer;
use App\Ticket;

class AppMailer
{
    protected $mailer;
    protected $fromAddress = 'support@supportticket.dev';
    protected $fromName = 'Support Ticket';
    protected $to;
    protected $subject;
    protected $view;
    protected $data = [];

    /**
     * AppMailer constructor.
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param $user
     * @param Ticket $ticket
     */
    public function sendTicketInformation($user, Ticket $ticket)
    {
        $this->to = $user->email;
        $this->subject = "[Ticket ID: $ticket->ticket_id] $ticket->title";
        $this->view = 'emails.ticket_info';
        $this->data = compact('user', 'ticket');

        return $this->deliver();
    }

    /**
     * Function to send the mail
     */
    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function($message){
            $message->from($this->fromAddress, $this->fromName)->to($this->to)->subject($this->subject);
        });
    }
}