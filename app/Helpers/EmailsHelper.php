<?php

namespace App\Helpers;

use App\Jobs\SendEmailJob;
use App\Models\EmailTemplate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Class EmailsHelper
 *
 * The Helper is Defined for send different mail.
 *
 * PHP version 7.1.3
 *
 * @category  Helper
 * @package   Modules\Helper
 * @author    BaoNC <chibao2704@gmail.com>
 * @copyright 2023 BaoNC Group
 * @license   Chetsapp Private Limited
 * @version   Release: @1.0@
 * @link      https://golsoft.com.vn
 * @since     Class available since Release 1.0
 */
class EmailsHelper
{
    private function _sendEmails($to, $name, $subject, $body)
    {
        try {
            $template = 'emails.custom_template';
            $details = [
                'title' => $subject,
                'body' => $body,
            ];

            // Mail::to($to, $name)->send(new EmailSendToUser($details));

            return ['status' => true, "msg" => "Success"];
        } catch (\Exception $e) {
            Log::error($e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return ['status' => false, 'msg' => $e->getMessage()];
        }
    }

    /**
     * Send mail.
     *
     * @param String $template   [Email html]
     * @param Array  $parameters [Required params]
     * @param Array  $config     [Send mail config]
     *
     * @return void
     */
    public function sendmail($template = '', $parameters = [], $config = [])
    {
        try {
            Mail::send(
                $template,
                $parameters,
                function ($mail) use ($config) {
                    $mail->to($config['email'], $config['name'])
                        ->from($config['from'])
                        ->subject($config['subject']);
                }
            );
        } catch (\Exception $e) {
        }
    }

    /**
     * Send mails in queue.
     *
     * @param String $to      [Mail to]
     * @param String $name    [From name]
     * @param String $subject [Mail subject]
     * @param String $body    [Mail body]
     *
     * @return void
     */
    public function _sendEmailsInQueue($to, $name, $view_template_email, $data = [])
    {
        try {
            if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
                return false;
            }
            $details['to'] = $to;
            $details['name'] = $name ?? null;
            $email_template = EmailTemplate::where('view_template_email', $view_template_email)->first();
            if ($email_template) {
                $template_body = $email_template->template_body ?? "";
                $template_subject = $email_template->template_subject ?? "";
                foreach ($data as $key => $data_detail) {
                    $template_body = str_replace('{' . $key . '}', $data_detail, $template_body);
                }
                $details['body'] = $template_body;
                $details['title'] = $template_subject;

                $job = (new SendEmailJob($details))->delay(Carbon::now()->addSeconds(1));
                dispatch($job);
            } else {
                Log::error('Không tìm thấy template email ' . $view_template_email);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    /**
     * Send user activate email.
     *
     * @param Object $user     [User object]
     * @param String $password [Password]
     *
     * @return Boolean
     */
    public function sendCustomerEmail($customer, $email_template, $title, $content)
    {

        $this->_sendEmailsInQueue(
            $customer->email,
            $customer->customer_name,
            $title,
            $content,
            $email_template,
        );

        return true;
    }
}
