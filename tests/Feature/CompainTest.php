<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CompainTest extends TestCase
{
    /**
     * Test create compain
     *
     * @return void
     */
    public function test_create_compain()
    {
        $response = $this->postJson('/api/compain/store', [
            "user_id" => 1,
            'name'=> "compain one",
            "date_from" => "2021-10-22",
            "date_to" => "2021-10-27",
            "daily_budget" => 150.00,
            "creative_upload" => [
                "image1.jpg"
            ]
        ]);

        $response->assertStatus(201)
        ->assertCreated();
    }

    /**
     * Test uploads compain creatives
     *
     * @return void
     */
    public function test_upload_creative_uploads()
    {
        $file = UploadedFile::fake()->image("1.jpg");
        $response = $this->post('/api/compain/store', [
            "user_id" => 1,
            'name'=> "compain one",
            "date_from" => "2021-10-22",
            "date_to" => "2021-10-27",
            "daily_budget" => 150.00,
            "creative_upload" => [
                $file
            ]
        ]);

        $response->assertStatus(201)
        ->assertCreated()
        ->assertJson([
            "compain" => [
                "id" => true,
                "user_id" => true,
                "name" => true,
                "date_from" => true,
                "date_to" => true,
                "daily_budget" => true,
                "total_budget" => true,
                "creative_upload" => true,
                "created_at" => true,
                "updated_at" => true
            ]
            ]);
    }

    public function test_update_compain()
    {
        $file = UploadedFile::fake()->image("new.jpg");
        $response = $this->post('/api/compain/1', [
            "user_id" => 1,
            'name'=> "compain one",
            "date_from" => "2021-10-22",
            "date_to" => "2021-10-27",
            "daily_budget" => 150.00,
            "creative_upload" => [
                $file
            ]
        ]);

        $response->assertStatus(200)
            ->assertJson([
                "compain" => [
                    "id" => true,
                    "user_id" => true,
                    "name" => true,
                    "date_from" => true,
                    "date_to" => true,
                    "daily_budget" => true,
                    "total_budget" => true,
                    "creative_upload" => true,
                    "created_at" => true,
                    "updated_at" => true
                ]
                ]);
    }

    public function test_get_single_compain()
    {
        $response = $this->get('/api/compain/5');

        $response->assertStatus(200)
            ->assertJson([
                "compain" => [
                    "id" => true,
                    "user_id" => true,
                    "name" => true,
                    "date_from" => true,
                    "date_to" => true,
                    "daily_budget" => true,
                    "total_budget" => true,
                    "creative_upload" => true,
                    "created_at" => true,
                    "updated_at" => true
                ]
        ]);
    }

    public function test_update_compain_not_found()
    {
        $file = UploadedFile::fake()->image("new.jpg");
        $response = $this->post('/api/compain/1', [
            "user_id" => 1,
            'name'=> "compain one",
            "date_from" => "2021-10-22",
            "date_to" => "2021-10-27",
            "daily_budget" => 150.00,
            "creative_upload" => [
                $file
            ]
        ]);

        $response->assertStatus(404);
    }

    public function test_get_single_compain_not_found()
    {
        $response = $this->get('/api/compain/1');

        $response->assertStatus(404);
    }

    

    public function test_delete_compain()
    {
        $response = $this->delete('/api/compain/5');

        $response->assertStatus(200)
        ->assertJson([
            'success' => "Compain deleted successfuly"
        ]);
    }

    public function test_delete_compain_not_found()
    {
        $response = $this->delete('/api/compain/1');
        $response->assertStatus(404);
    }
}
