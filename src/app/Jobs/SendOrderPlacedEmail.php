<?php

namespace App\Jobs;

use App\Mail\OrderPlaced;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class SendOrderPlacedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;


    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        Mail::send(new OrderPlaced($this->order));
    }

}
