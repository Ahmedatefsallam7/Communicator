<?php

namespace Modules\Communicator\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Modules\Communicator\App\Models\Template;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedEmailTemplates();
        $this->seedSmsTemplates();
    }

    /**
     * Seed the database with email templates.
     */
    private function seedEmailTemplates(): void
    {
        $templates = json_decode(File::get('Modules\\Communicator\\resources\\views\\emails\\templates.json'), true);

        foreach ($templates['templates'] as $template) {
            Template::create([
                'name' => json_encode(['en' => $template['name_en'], 'ar' => $template['name_ar']]),
                'type' => 'email',
                'subject' => json_encode(['en' => $template['subject']['en'], 'ar' => $template['subject']['ar']]),
                'body_text' => json_encode(['en' => $template['body']['text']['en'], 'ar' => $template['body']['text']['ar']]),
                'path' => $template['name_en'],
                'variables' => json_encode([
                    'en' => array_values(array_map(fn ($v) => $v['description']['en'], $template['variables'])),
                    'ar' => array_values(array_map(fn ($v) => $v['description']['ar'], $template['variables'])),
                    'url' => $template['variables']['url']['value'] ?? null
                ]),
                'cc' => "ahmedatefsallam7@gmail.com",
                'bcc' => "ahmedatefsallam7@gmail.com",
            ]);
        }
    }

    /**
     * Seed the database with SMS templates.
     */
    private function seedSmsTemplates(): void
    {
        $smsData = $this->getSmsData();

        Template::query()->insert($smsData);
    }

    /**
     * Get data for SMS templates.
     */
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
