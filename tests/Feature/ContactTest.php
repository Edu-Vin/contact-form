<?php

namespace Tests\Feature;

use App\Notifications\NewContact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {

        parent::setUp();

        Notification::fake();

    }

    public function testShowContactPage()
    {
        $this->get('/')
            ->assertStatus(200);
    }

    public function testFormRequiredFields()
    {

        $this->post('contact/create', [])
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors(['attachment'])
            ->assertSessionHasErrors(['name', 'email', 'message']);
    }

    public function testUnsupportedFileUpload()
    {

        $file = UploadedFile::fake()->create('document.docx', '100', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');

        $this->post('contact/create', [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'message' => $this->faker->text,
            'attachment' => $file,
        ])
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors(['name', 'message', 'email'])
            ->assertSessionHasErrors(['attachment']);

    }

    public function testFormEmailValidation()
    {
        $this->post('contact/create', [
            'name' => $this->faker->name,
            'email' => 'hello@gmail',
            'message' => $this->faker->text,
        ])
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors(['name', 'message', 'attachment'])
            ->assertSessionHasErrors(['email']);
    }

    public function testSuccessfullFormSubmissionWithoutFile()
    {

        $this->post('contact/create', [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'message' => $this->faker->text,
        ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success', 'Form Submitted Successfully');

        Notification::assertSentTo(
            new AnonymousNotifiable, NewContact::class
        );

    }

    public function testSuccessfullFormSubmissionWithFile()
    {

        Storage::fake('local');

        $file = UploadedFile::fake()->create('document.pdf', '100', 'application/pdf');

        $this->post('contact/create', [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'message' => $this->faker->text,
            'attachment' => $file,
        ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success', 'Form Submitted Successfully');

        Storage::disk('local')->assertExists('uploads/' . $file->hashName());

        Notification::assertSentTo(
            new AnonymousNotifiable, NewContact::class
        );

    }

    public function testRateLimiting()
    {

        $this->post('contact/create', [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'message' => $this->faker->text,
        ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success', 'Form Submitted Successfully')
            ->assertHeader('X-RATELIMIT-REMAINING', 0);

        Notification::assertSentTo(
            new AnonymousNotifiable, NewContact::class
        );

        $this->post('contact/create', [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'message' => $this->faker->text,
        ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('error');

    }
}
