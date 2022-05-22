<?php

namespace App\Notifications\Admin;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use App\Enums\NotificationType;
use App\Traits\MakeNotification;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OrderCancelNotification extends Notification
{
    use Queueable, MakeNotification;

    /**
     * New order instance
     */
    private $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return  $this->make([
            "title"    => "An order canceled",
            "subtitle" => "Invoice No: {$this->order->invoiceNo}",
            "link"     => "/admin/orders/{$this->order->id}",
            "type"     => NotificationType::DANGER(),
        ]);
    }
}