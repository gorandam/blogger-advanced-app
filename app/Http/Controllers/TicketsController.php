<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TicketFormRequest;// this tells we can use our request class for valdation
use App\Ticket;// This tells we can use Ticket model in the this class
use Illuminate\Support\Facades\Mail; //This tells we can use Mail facade here

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()// method to view all tickets
    {
        $tickets = Ticket::all();// It will return Collection object that contains our model instances
        return view('tickets.index', compact('tickets'));// here we return view response object and pass array data with it
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketFormRequest $request)
    {
      $slug = uniqid();//PHP built-in function genereate unique ID based on current miliseconds
      $ticket = new Ticket(array(
          'title' => $request->get('title'), // get() returns item at the given key as argument
          'content' => $request->get('content'),
          'slug' => $slug
      ));

      $ticket->save();

      $data = array(
        'ticket' => $slug,
      );
      Mail::send('emails.ticket', $data, function ($message) {// Here we have three arguments: VIEW for bodytext of mail, $data for data for body, CLOSURE
        $message->from('goran.dam@gmail.com', 'Laravel Freak');
        $message->to('goran.dam@gmail.com')->subject('There is a new ticket!');
      });

      return redirect('/tickets')->with('status', 'Your ticket has been created! Its unique id is: '.$slug);// redirect() is global helper for create redirect response instance

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)// method to view specific ticket
    {
        $ticket = Ticket::whereSlug($slug)->first();// here we staticly call whereSlug and first methods
        $comments = $ticket->comments()->get();// Here we get firt HasMany relationship instance object and call get() fetch method on it to get collectin object
        return  view('tickets.show', compact('ticket', 'comments'));// here we create view resonse object and pass as array our instance of Ticket model
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)//method to display edit from page
    {
        $ticket = Ticket::whereSlug($slug)->first();
        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($slug, TicketFormRequest $request )
    {
        $ticket = Ticket::whereSlug($slug)->first();
        $ticket->title = $request->get('title');
        $ticket->content = $request->get('content');
        if($request->get('status') != null) {
          $ticket->status = 0;
        } else {
          $ticket->status = 1;
        }
        $ticket->save();
        return redirect(action('TicketsController@index', $ticket->slug))->with('status', 'The ticket '. $slug. 'has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $ticket = Ticket::whereSlug($slug)->first();
        $ticket->delete();
        return redirect('/tickets')->with('status', 'The ticket '.$slug.' has been deleted!');
    }
}
