<?php 
namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Logout;

    class LogSuccessfulLogout
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
         * @param  Logout  $event
         * @return void
         */
        public function handle(Logout $event)
        {
            $user = User::find($event->user->id);
            $user->status = 0;
            $user->save();
        }
    }