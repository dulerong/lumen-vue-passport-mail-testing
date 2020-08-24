<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use App\User;
use App\Stat;

class HttpTest extends TestCase
{
    // use DatabaseMigrations;
    // if I use DatabaseMigrations, it migrates and roll back database for each test, 
    // unfortunately it also deletes all my production database, hence decided not to use it
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRoot()
    {
        $this->get('/')
            ->seeStatusCode(200);
    }

    public function testRegister()
    {
        $data = [
            'name' => 'Kevin Tester',
            'email'=> 'kevin_testing@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $this->post('/register', $data)
            ->seeStatusCode(200)
            ->seeInDatabase('users', ['email' => 'kevin_testing@gmail.com']);

        User::where('email', 'kevin_testing@gmail.com')->delete(); // deleting the user I created for this test
    }

    public function testRestrictedRoutesNoAuth()
    {
        $this->get('/api/stats')
            ->seeStatusCode(401);
    }

    public function testRestrictedRoutesWithAuth()
    {
        $user = factory('App\User')->create();

        $this->actingAs($user)
            ->get('/api/stats')
            ->seeStatusCode(200)
            ->seeJson([]);
        
        User::where('email', $user->email)->delete(); // deleting the user I created for this test
    }

    public function testCreateStat()
    {
        $user = factory('App\User')->create();
        $data = [
            'selected' => '新北市三重區',
            'motherAge' => '20～24歲',
            'birthOrder' => '所有胎數',
            'birthGender' => '所有性別',
            'birthCount' => '100',
            'birthMale' => '60',
            'birthFemale' => '40',
            'comment' => 'Test Record!'
        ];

        $this->actingAs($user)
            ->post('/api/stats', $data)
            ->seeStatusCode(200)
            ->seeJson([
                'location' => '新北市三重區',
                'age'      => '20～24歲',
                'birthorder' => '所有胎數',
                'gender'   => '所有性別',
                'comment'  => 'Test Record!'
            ]);

        User::where('email', $user->email)->delete();
        Stat::where('comment', 'Test Record!')->delete();
    }

    public function testDeleteStat()
    {
        $user = factory('App\User')->create();

        $data = [
            'selected' => '新北市三重區',
            'motherAge' => '20～24歲',
            'birthOrder' => '所有胎數',
            'birthGender' => '所有性別',
            'birthCount' => '2',
            'birthMale' => '1',
            'birthFemale' => '1',
            'comment' => 'Test Record for Delete'
        ];

        $this->actingAs($user)
            ->post('/api/stats', $data)
            ->seeStatusCode(200);

        $stat = Stat::where('user_id', $user->id)->first();
        $id   = $stat->id;


        $this->actingAs($user)
            ->delete("/api/stats/{$id}")
            ->seeStatusCode(200)
            ->seeJson(['Deleted Successfully!']);

        $user->delete();
    }
}
