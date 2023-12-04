<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\ContactType;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_have_three_contact_types()
    {
        // Ensure there are only three instances
        $this->assertCount(3, ContactType::all());
    }

    /** @test */
    public function it_have_no_other_than_three_contact_types()
    {
        // Try to call the fourth contact type
        $contactType4 = ContactType::find(4);

        // Ensure the fourth instance not exist
        $this->assertNull($contactType4);
    }
}
