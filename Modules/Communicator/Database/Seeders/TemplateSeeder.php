<?php

namespace Modules\Communicator\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Modules\Communicator\App\Models\Template;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = json_decode(File::get('Modules\\Communicator\\resources\\views\\emails\\templates.json'), true);

        foreach ($templates['templates'] as $template) {
            DB::table('templates')->insert([
                'name' => $template['name'],
                'subject' => $template['subject'],
                'path' => base_path() . "\resources\\views\\emails",
                'body_text' => $template['body']['text'],
                'variables' => json_encode($template['variables']),
                'cc' => "ahmedatef@gmail.com",
                'bcc' => "ahmedatef@gmail.com",
                'created_at' => now()
            ]);
        }

        $smsData = $this->getSmsData();

        Template::query()->insert($smsData);
    }
    private function getSmsData(): array
    {
        return [
            [
                'name' => json_encode(['en' => 'sms1', 'ar' => 'الرساله الاولي']),
                'type' => 'sms',
                'body_text' => json_encode(['en' => 'SMS1', 'ar' => 'الرساله الاولي']),
                'subject' => json_encode(['en' => 'SMS1', 'ar' => 'الرساله الاولي']),
                'variables' => json_encode(['en' => ['name'], 'ar' => ['الاسم']]),
                'created_at' => now()
            ],
            [
                'name' => json_encode(['en' => 'sms2', 'ar' => 'الرساله الثانيه']),
                'type' => 'sms',
                'body_text' => json_encode(['en' => 'SMS2', 'ar' => 'الرساله الثانيه']),
                'subject' => json_encode(['en' => 'SMS2', 'ar' => 'الرساله الثانيه']),
                'variables' => json_encode(['en' => ['name'], 'ar' => ['الاسم']]),
                'created_at' => now()
            ],
            [
                'name' => json_encode(['en' => 'sms3', 'ar' => 'الرساله الثالثه']),
                'type' => 'sms',
                'body_text' => json_encode(['en' => 'SMS3', 'ar' => 'الرساله الثالثه']),
                'subject' => json_encode(['en' => 'SMS3', 'ar' => 'الرساله الثالثه']),
                'variables' => json_encode(['en' => ['name'], 'ar' => ['الاسم']]),
                'created_at' => now()
            ],
        ];
    }
}
