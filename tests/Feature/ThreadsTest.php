<?php

namespace Tests\Feature;

use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * 测试用户可以看见threads
     */
    public function testUserCanBrowseThreads()
    {
        $thread = factory(Thread::class)->create();

        $response = $this->get('/threads');

        $response->assertSee($thread->title);
    }

    /**
     * 用户查看单个thread
     */
    public function testUserCanBrowseThread()
    {
        $thread = factory(Thread::class)->create();

        $response = $this->get('/threads/' . $thread->id);
        $response->assertSee($thread->title);
    }


}
