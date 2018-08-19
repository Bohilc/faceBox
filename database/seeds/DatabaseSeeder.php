<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Friend;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);


        $faker = Faker::create('pl_PL');
        $number_of_users = 20;
        $max_posts = 10;
        $password = 'pass';

        // create users
        for ($user_id = 1; $user_id <= $number_of_users; $user_id++) {
            $sex = $faker->randomElement(['m', 'f']);

            if ($user_id === 1) {
                DB::table('users')->insert([
                    'name' => 'Bohdan',
                    'lastName' => 'Ilchuk',
                    'email' => 'b.m.ilchuk@gmail.com',
                    'sex' => 'm',
                    'avatar' => null,
                    'password' => Hash::make($password),
                ]);
            } else {
                switch ($sex) {
                    case 'm':
                        $name = $faker->firstNameMale;
                        $lastName = $faker->lastNameMale;
                        $img = json_decode(file_get_contents('https://randomuser.me/api/?gender=male'))->results[0]->picture->large;
                        break;

                    case 'f':
                        $name = $faker->firstNameFemale;
                        $lastName = $faker->lastNameFemale;
                        $img = json_decode(file_get_contents('https://randomuser.me/api/?gender=female'))->results[0]->picture->large;
                        break;
                }

                DB::table('users')->insert([
                    'name' => $name,
                    'lastName' => $lastName,
                    'email' => str_replace('-', '', str_slug($name . $lastName)) . '@' . $faker->safeEmailDomain,
                    'sex' => $sex,
                    'avatar' => $img,
                    'password' => Hash::make($password),
                ]);
            }

            // create friends
            for ($i = 1; $i <= $faker->numberBetween($min = 0, $max = $number_of_users - 1); $i++) {

                $friend_id = $faker->numberBetween($min = 1, $max = $number_of_users);

                $friendship_exist =
                    Friend::where('user_id', $user_id)
                        ->where('friend_id', $friend_id)
                        ->orWhere('user_id', $friend_id)
                        ->where('friend_id', $user_id)
                        ->exists();

                if (!$friendship_exist) {
                    DB::table('friends')->insert([
                        'user_id' => $user_id,
                        'friend_id' => $friend_id,
                        'accepted' => 1,
                        'created_at' => $faker->dateTimeThisYear($max = 'now')
                    ]);
                }
            }

            // create posts

            for ($post_id = 1; $post_id <= $faker->numberBetween($min = 0, $max = $max_posts); $post_id++) {
                DB::table('posts')->insert([
                    'user_id' => $user_id,
                    'content' => $faker->paragraph($nbSentences = 1, $variableNbSentences = true),
                    'created_at' => $faker->dateTimeThisYear($max = 'now')
                ]);
            }
        }
    }
}
