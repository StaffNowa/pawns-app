<?php

namespace Feature;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_can_be_updated_and_points_awarded()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson('/api/profile', [
            'answers' => ['q1' => 'answer1', 'q2' => 'answer2'],
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Profile updated and 5 points awarded']);

        $this->assertDatabaseHas('user_profiles', [
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('points_transactions', [
            'user_id' => $user->id,
            'points' => 5,
        ]);
    }

    public function test_profile_cannot_be_updated_more_than_once_a_day()
    {
        $user = User::factory()->create();

        UserProfile::create([
            'user_id' => $user->id,
            'updated_at' => now(),
            'answers' => ['q1' => 'answer1', 'q2' => 'answer2'],
        ]);
        $this->actingAs($user);

        $response = $this->postJson('/api/profile', [
            'answers' => ['q1' => 'answer1', 'q2' => 'answer2'],
        ]);

        $response->assertStatus(403);

        $response->assertJson([
            'error' => 'Profile can only be updated once a day',
        ]);
    }

    public function test_validation_fails_without_answers()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->postJson('/api/profile');

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['answers']);
    }
}
