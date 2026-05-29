<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 1. Seed User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
        }

        // 2. Seed Menus
        $menus = [
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'About', 'url' => '/#about'],
            ['label' => 'Portfolio', 'url' => '/#projects'],
            ['label' => 'Skills', 'url' => '/#skills'],
            ['label' => 'Ventures', 'url' => '/#ventures'],
            ['label' => 'Contact', 'url' => '/#contact'],
        ];

        foreach ($menus as $index => $menu) {
            Menu::create([
                'label' => $menu['label'],
                'url' => $menu['url'],
                'order' => $index + 1,
                'is_active' => true,
            ]);
        }

        // 3. Seed Projects
        for ($i = 1; $i <= 6; $i++) {
            Project::create([
                'title' => 'Project ' . $i . ': ' . $faker->sentence(3),
                'description' => $faker->paragraph(),
                'image' => 'https://via.placeholder.com/600x400?text=Project+' . $i,
                'link' => $faker->url,
                'is_published' => true,
                'order' => $i,
            ]);
        }

        // 4. Seed Skills
        $skills = [
            ['name' => 'PHP', 'color' => '#777BB4'],
            ['name' => 'Laravel', 'color' => '#FF2D20'],
            ['name' => 'JavaScript', 'color' => '#F7DF1E'],
            ['name' => 'Vue.js', 'color' => '#4FC08D'],
            ['name' => 'Tailwind CSS', 'color' => '#06B6D4'],
            ['name' => 'MySQL', 'color' => '#4479A1'],
        ];

        foreach ($skills as $index => $skill) {
            Skill::create([
                'name' => $skill['name'],
                'icon' => null,
                'color' => $skill['color'],
                'proficiency' => rand(70, 100),
                'order' => $index + 1,
            ]);
        }

        // 6. Seed Settings
        $settings = [
            'site_name' => 'Global Tech Corp',
            'site_description' => 'Penyedia solusi teknologi terbaik untuk bisnis Anda.',
            'contact_email' => 'info@globaltech.com',
            
            // Hero Section Settings (Eye-catching)
            'hero_subtitle' => 'INNOVATION & TECHNOLOGY',
            'hero_title' => 'Architecting Next-Gen Digital Solutions',
            'hero_description' => 'Kami mendesain, membangun, dan menskalakan produk digital kelas dunia yang memberdayakan bisnis Anda untuk memimpin di era digital.',
            
            // Company Information (for About menu)
            'company_name' => 'PT Global Teknologi Nusantara',
            'company_tagline' => 'Inovasi Tanpa Batas untuk Masa Depan Digital',
            'company_description' => 'PT Global Teknologi Nusantara adalah perusahaan teknologi terkemuka yang berdedikasi untuk menciptakan solusi digital berdampak tinggi. Kami membantu korporasi dan startup merancang, membangun, dan meluncurkan produk perangkat lunak kelas dunia.',
            'company_address' => 'Jl. Jenderal Sudirman No. 12, Jakarta Selatan, Indonesia',
            
            // Developer Information (for Contact section)
            'developer_name' => 'Budi Santoso',
            'developer_bio' => 'Budi Santoso adalah Lead Full-Stack Developer di PT Global Teknologi Nusantara. Dengan lebih dari 7 tahun pengalaman dalam ekosistem PHP, Laravel, dan modern Javascript, Budi senang memecahkan masalah arsitektur yang kompleks dan membangun produk digital yang user-friendly.',
            
            // Dynamic Social Links
            'github_url' => 'https://github.com/budisantoso',
            'linkedin_url' => 'https://linkedin.com/in/budisantoso',
            'twitter_url' => 'https://twitter.com/budisantoso',
            'instagram_url' => 'https://instagram.com/budisantoso',
        ];

        foreach ($settings as $key => $value) {
            Setting::create([
                'key' => $key,
                'value' => $value,
            ]);
        }
    }
}
