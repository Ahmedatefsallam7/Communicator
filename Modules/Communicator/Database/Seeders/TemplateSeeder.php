<?php

namespace Modules\Communicator\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Communicator\App\Models\Template;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email_data = [
            [
                'name' => json_encode(['en' => 'welcome_email', 'ar' => 'إيميل ترحيب']),
                'type' => 'email',
                'path' => json_encode(base_path() . "\resources\\views\\emails"),
                'body' => json_encode(['en' => 'Welcome email', 'ar' => 'إيميل ترحيب']),
                'subject' => json_encode(['en' => 'Welcome email', 'ar' => 'إيميل ترحيب']),
                'sender' => "Ahmed Atef",
                'variable' => json_encode(['en' => ['name', 'email'], 'ar' => ['الاسم', 'إيميل']]),
                'cc' => json_encode("ahmedatef@gmail.com"),
                'bcc' => json_encode("ahmedatef@gmail.com"),
            ], [
                'name' => json_encode(['en' => 'reminder_email', 'ar' => 'إيميل تزكير']),
                'type' => 'email',
                'path' => json_encode(base_path() . "\resources\\views\\emails"),
                'body' => json_encode(['en' => 'Reminder email', 'ar' => 'إيميل تزكير']),
                'subject' => json_encode(['en' => 'Reminder email', 'ar' => 'إيميل تزكير']),
                'sender' => "Ahmed Atef",
                'variable' => json_encode(['en' => ['name', 'email'], 'ar' => ['الاسم', 'إيميل']]),
                'cc' => json_encode("ahmedatef@gmail.com"),
                'bcc' => json_encode("ahmedatef@gmail.com"),
            ]
        ];


        $sms_data = [
            [
                'name' => json_encode(['en' => 'sms', 'ar' => 'رساله نصيه']),
                'type' => 'sms',
                'body' => json_encode(['en' => 'SMS', 'ar' => 'رساله نصيه']),
                'subject' => json_encode(['en' => 'SMS', 'ar' => 'رساله نصيه']),
                'sender' => "Ahmed Atef",
                'variable' => json_encode(['en' => ['name'], 'ar' => ['الاسم']]),
            ],
            [
                'name' => json_encode(['en' => 'sms', 'ar' => 'رساله نصيه']),
                'type' => 'sms',
                'body' => json_encode(['en' => 'SMS', 'ar' => 'رساله نصيه']),
                'subject' => json_encode(['en' => 'SMS', 'ar' => 'رساله نصيه']),
                'sender' => "Ahmed Atef",
                'variable' => json_encode(['en' => ['name'], 'ar' => ['الاسم']]),
            ],

        ];


        Template::query()->insert($email_data);
        Template::query()->insert($sms_data);
    }
}
