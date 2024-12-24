<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private mixed $token;
    private mixed $time;

    public function __construct($token, $time)
    {
        $this->token = $token;
        $this->time = $time;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = route('resetPW', ['token' => $this->token]);
        return (new MailMessage)
            ->subject('Thông báo: Yêu cầu đặt lại mật khẩu')
            ->line('Bạn nhận được email này vì chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.')
            ->line('Link đặt lại mật khẩu sẽ hết hạn sau ' . $this->time . ' phút.')
            ->action('Đặt lại mật khẩu', $url)
            ->line('Nếu bạn không yêu cầu đặt lại mật khẩu, không cần thực hiện thêm hành động nào.');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
