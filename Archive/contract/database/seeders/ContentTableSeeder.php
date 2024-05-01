<?php

namespace Database\Seeders;

use App\Models\Content;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::table('content')->truncate();
            $data = [
                [
                    'id' => 1,
                    'content_slug' => BANNER_CONTENT,
                    'title' => 'Automated Contract Generation For SMEs',
                    'content' => 'Save time and money and create simple and best practice contracts in minutes.',
                    'status' => 1
                ],
                [
                    'id' => 2,
                    'content_slug' => OUR_CONTRACT_LIBRARY,
                    'title' => 'Our Contract Library',
                    'content' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.',
                    'status' => 1
                ],
                [
                    'id' => 3,
                    'content_slug' => PRICING_PLANS,
                    'title' => 'Pricing & Plans',
                    'content' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.',
                    'status' => 1
                ],
                [
                    'id' => 4,
                    'content_slug' => MEET_OUR_TEAM,
                    'title' => 'Meet Our Team',
                    'content' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.',
                    'status' => 1
                ],
                [
                    'id' => 5,
                    'content_slug' => OUR_TESTIMONIALS,
                    'title' => 'Our Testimonials',
                    'content' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.',
                    'status' => 1
                ],
                [
                    'id' => 6,
                    'content_slug' => READY_TO_DIVE,
                    'title' => 'Ready to dive in?',
                    'content' => 'Start your free trial today.',
                    'status' => 1
                ]
            ];
            DB::table('content')->insert($data);
        } catch (Exception $e) {
            Log::error('Error to run seeder -> '.$e->getMessage());
        }
    }
}
