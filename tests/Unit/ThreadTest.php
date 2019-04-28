<?php

namespace Tests\Unit;

use App\Thread;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    protected function setUp()
    {
        parent::setUp();
        $this->thread = factory(Thread::class)->create();
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testThreadHasReplies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    public function testThreadHasCreator()
    {
        $this->assertInstanceOf(User::class, $this->thread->creator);
    }
}
