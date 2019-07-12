<?php

namespace App\Listeners;

use App\AuthorBook;
use App\Events\onEditBookEvent;
use App\RubricBook;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EditBookListener
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
    public function handle(onEditBookEvent $event)
    {
        foreach ($event->old_authors as $old_author) {
            $old_author->delete();
        }

        if($event->new_authors != null) {
            foreach ($event->new_authors as $new_author_id) {
                AuthorBook::create([
                    'book_id' => $event->book_id,
                    'author_id' => $new_author_id,
                ]);
            }
        }

        foreach ($event->old_rubrics as $old_rubric) {
            $old_rubric->delete();
        }

        if($event->new_rubrics != null) {
            foreach ($event->new_rubrics as $new_rubric_id) {
                RubricBook::create([
                    'book_id' => $event->book_id,
                    'rubric_id' => $new_rubric_id,
                ]);
            }
        }
    }
}
