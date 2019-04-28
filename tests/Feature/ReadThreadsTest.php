<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    protected function setUp()
    {
        parent::setUp();
        $this->thread = factory('App\Thread')->create();
    }

    /**
     * 测试用户可以看见threads
     */
    public function testUserCanBrowseThreads()
    {
        $response = $this->get('/threads');

        $response->assertSee($this->thread->title);
    }

    /**
     * 用户查看单个thread
     */
    public function testUserCanBrowseThread()
    {

        $response = $this->get('/threads/' . $this->thread->id);
        $response->assertSee($this->thread->title);
    }


    public function testUserCanReadRepliesThatAreAssociatedWithThread()
    {
        // 如果存在 Thread
        // 并且该 Thread 拥有回复
        $reply = factory(Reply::class)->create(['thread_id' => $this->thread->id]);
        // 那么当我们看该 Thread 时
        // 我们也要看到回复
        $this->get('/threads/'.$this->thread->id)
            ->assertSee($reply->body);
    }

}
