<?php

namespace App\Traits;

use Illuminate\Support\Facades\Mail;
use Modules\Communicator\App\Emails\UserMail;
use Modules\Communicator\App\Models\Template;

trait GeneralTrait
{
    public function getCurrentLang()
    {
        return app()->getLocale();
    }

    public function successResponse($message, $data = null)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 200);
    }

    public function errorResponse($message, $errors = null, $status_code = 422)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => [$errors]
        ], $status_code);
    }

    public function forbiddenAccessResponse($message, $errors = null, $status_code = 403)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => [$errors]
        ], $status_code);
    }

    public function notFoundResponse($message = null, $status = null)
    {
        return response()->json([
            'status' => $status ?? false,
            'message' => $message ?? __('main.missing_data'),
            'data' => null
        ], 404);
    }

    public function unsetNullValues(array $data)
    {
        return array_filter($data, fn ($val) => $val !== null || $val !== false || $val !== '');
    }

    public function sendEmail($message, $recipientEmail, $templateName)
    {
        $template = Template::query()
            ->whereName($templateName)
            ->firstOrFail();

        $subject = $template->subject;
        $bodyText = $template->body_text;

        Mail::to($recipientEmail)->send(new UserMail($message, $subject,  $bodyText));
    }

    function sendSMS($sender, $recipient, $content)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://dk62xl.api.infobip.com/sms/2/text/advanced',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"messages":[{"destinations":[{"to":"' . $recipient . '"}],"from":"' . $sender . '","text":"' . $content . '"}]}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: App ed05e4f13cf3788c33e1faa94df47210-d20c0b1f-a088-4e1a-8b27-c51d939c00e3',
                'Content-Type: application/json',
                'Accept: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
