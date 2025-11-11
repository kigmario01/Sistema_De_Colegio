<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_requires_authentication(): void
    {
        $response = $this->getJson('/api/students');

        $response->assertStatus(401);
    }

    public function test_authenticated_user_can_list_students(): void
    {
        $this->seed();
        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/students');

        $response->assertOk()->assertJsonStructure(['data']);
    }
}
