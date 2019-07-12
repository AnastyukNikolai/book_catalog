<?php

namespace App\Events;

use App\AuthorBook;
use App\Book;
use App\Http\Requests\AddBookRequest;
use App\RubricBook;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class onEditBookEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $book_id;
    public $old_authors;
    public $old_rubrics;
    public $new_authors;
    public $new_rubrics;

    public function __construct(AddBookRequest $request, Book $book)
    {
        $this->book_id = $book->id;
        $this->old_authors = AuthorBook::where('book_id', $this->book_id)->get();
        $this->old_rubrics = RubricBook::where('book_id', $this->book_id)->get();
        $this->new_authors = $request->authors;
        $this->new_rubrics = $request->rubrics;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
