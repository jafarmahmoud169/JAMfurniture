<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\DiscountEmail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Exception;
use Illuminate\Support\Facades\Log;

class SendDiscountNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;          // Number of retry attempts
    public $timeout = 200;       // Max execution time per try (in seconds)
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function handle()
    {
        $users = User::where('wants_notifications', 1)->get();

        foreach ($users as $user) {
            try {
                Mail::to($user->email)->send(new DiscountEmail($this->product, $user));
            } catch (Exception $e) {
                Log::channel('email')->error("Failed to send email to {$user->email}: {$e->getMessage()}");
                throw $e; // Rethrow to activate retry logic
            }
        }
    }

    public function failed(Exception $e)
    {
        Log::error("SendDiscountNotification job failed: " . $e->getMessage());
        // Optional: notify admin or log to database
    }
}
