<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\ClientType;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_have_two_client_types()
    {
        // Ensure there are only two instances
        $this->assertCount(2, ClientType::all());
    }

    /** @test */
    public function it_have_no_other_than_two_client_types()
    {
        // Try to call the third client type
        $clientType4 = ClientType::find(3);

        // Ensure the third instance not exist
        $this->assertNull($clientType4);
    }
}
