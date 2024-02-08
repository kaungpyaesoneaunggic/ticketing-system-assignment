<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Category;
use App\Models\Label;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        if ($user->role == 0) {
            $tickets = Ticket::all();
        } else if ($user->role == 1) {
            $tickets = Ticket::where('agent_id', $user->id)->get();
        } else {
            $tickets = Ticket::where('user_id',  $user->id)->get();
        }
        $ticketCategoryIds = $tickets->mapWithKeys(function ($ticket) {
            return [$ticket->id => $ticket->categories->pluck('id')->toArray()];
        });
        $ticketLabelIds = $tickets->mapWithKeys(function ($ticket) {
            return [$ticket->id => $ticket->labels->pluck('id')->toArray()];
        });
        $ticketImages = $tickets->mapWithKeys(function ($ticket) {
            return [$ticket->id => $ticket->images->pluck('image')->toArray()];
        });

        return view('ticket.index', compact('tickets', 'ticketCategoryIds', 'ticketLabelIds', 'ticketImages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        try{
            $this->authorize('create');
            $labels = Label::all();
            $categories = Category::all();
            return view('ticket.create', compact('labels', 'categories'));
        }catch(AuthorizationException $e){
            return $e;
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        //
        $ticket = new Ticket();
        $ticket->user_id = Auth::user()->id;
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->priority = $request->priority;
        $ticket->status = 'open';
        $ticket->save();
        // Attach categories if provided
        if ($request->has('category_ids')) {
            $ticket->categories()->attach($request->category_ids);
        }

        // Attach labels if provided
        if ($request->has('label_ids')) {
            $ticket->labels()->attach($request->label_ids);
        }
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $newImageName = "gallery_" . uniqid() . "." . $image->extension();
                $image->storeAs('public/gallery', $newImageName);
                $ticket->images()->create([
                    'ticket_id' => $request->id,
                    'image' => $newImageName
                ]);
            }
        }
        return redirect()->route('ticket.index')->with('success', 'Ticket Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        try {
            $this->authorize('edit', $ticket);
            $labels = Label::all();
            $categories = Category::all();
            $agents = User::where('role', '1')->get(); //1 means agent
            $selectedCategoryIds = $ticket->categories->pluck('id')->toArray();
            $selectedLabelIds = $ticket->labels->pluck('id')->toArray();
            return view('ticket.edit', compact('ticket', 'labels', 'categories', 'agents','selectedCategoryIds','selectedLabelIds'));
        }catch(AuthorizationException $e){
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        // Update the existing ticket
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->priority = $request->priority;
        $ticket->status = $request->status;
        $ticket->agent_id = $request->agent_id;
        $ticket->update();

        // Attach categories if provided
        if ($request->has('category_ids')) {
            $ticket->categories()->sync($request->category_ids);
        }

        // Attach labels if provided
        if ($request->has('label_ids')) {
            $ticket->labels()->sync($request->label_ids);
        }

        // Handle images
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $newImageName = "gallery_" . uniqid() . "." . $image->extension();
                $image->storeAs('public/gallery', $newImageName);
                // Create a new image record related to the ticket
                $ticket->images()->create([
                    'image' => $newImageName,
                ]);
            }
        }

        return redirect()->route('ticket.index')->with('success', 'Ticket updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
        try{
            $this->authorize('delete', $ticket);
            if($ticket){
                foreach ($ticket->images as $image) {
                    $path = 'public/gallery/' . $image->image;
                    Storage::delete($path);
                }
                $ticket->images()->delete();
                $ticket->labels()->detach();
                $ticket->categories()->detach();
                $ticket->delete();
                return redirect()->route('ticket.index')->with("delete","deleted successfully");
            }
            return redirect()->route('ticket.index')->with('delete','Delete wasnt success');
            
        }catch(AuthorizationException $e){
            return $e;
        }
        
    }
}
