<?php

namespace Tests\Unit;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ContactFormTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function request_should_fail_when_no_name_is_provided(): void
    {
        $response = $this->postJson(route('contact.process'), [
            'message' => $this->faker->paragraph,
            'email' => $this->faker->email
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function request_should_fail_when_no_email_is_provided(): void
    {
        $response = $this->postJson(route('contact.process'), [
            'name' => $this->faker->name,
            'message' => $this->faker->paragraph
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function request_should_fail_when_no_message_is_provided(): void
    {
        $response = $this->postJson(route('contact.process'), [
            'name' => $this->faker->name,
            'email' => $this->faker->email
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors('message');
    }

    /** @test */
    public function request_should_fail_when_email_is_invalid(): void
    {
        $response = $this->postJson(route('contact.process'), [
            'name' => $this->faker->name,
            'message' => $this->faker->paragraph,
            'email' => 'testemail'
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function request_should_pass_when_all_required_data_are_provided(): void
    {
        $response = $this->postJson(route('contact.process'), [
            'name' => $this->faker->name,
            'message' => $this->faker->paragraph,
            'email' => $this->faker->email
        ]);

        $response->assertRedirect(route('contact.index'));
        $response->assertStatus(Response::HTTP_FOUND);
    }

}
