<?php

namespace App\Listeners;

use App\AuthorBook;
use App\Events\onAddBookEvent;
use App\RubricBook;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddBookListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(onAddBookEvent $event)
    {
        if($event->authors != null) {
            foreach ($event->authors as $author_id) {
                AuthorBook::create([
                    'book_id' => $event->book_id,
                    'author_id' => $author_id,
                ]);
            }
        }

        if($event->rubrics != null) {
            foreach ($event->rubrics as $rubric_id) {
                RubricBook::create([
                    'book_id' => $event->book_id,
                    'rubric_id' => $rubric_id,
                ]);
            }
        }
    }
}
