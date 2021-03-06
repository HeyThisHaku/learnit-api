<?php

use App\Category;
use App\Course;
use App\CourseDetail;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $time = new DateTime(null,new DateTimeZone('Asia/Jakarta'));
        for($i =0; $i<30; $i++){
            $course = new Course;
            $course->course_id = uniqid();
            $course->user_id =  User::all()->random(10)->first()->user_id;
            $course->category_id = Category::all()->random(1)->first()->category_id;
            $course->course_title = $faker->randomElement(['Science','Social',"Math","Algorithm"]);
            $course->max_enroll_student = rand(10,20);
            $course->max_learning_day = rand(30,40);
            $course->information = "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rem ullam quod omnis non voluptates officiis quia commodi fugit quibusdam! Cum explicabo eius velit cupiditate, corrupti atque accusamus possimus iure maxime! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rem ullam quod omnis non voluptates officiis quia commodi fugit quibusdam! Cum explicabo eius velit cupiditate, corrupti atque accusamus possimus iure maxime!";
            $course->course_image = "https://i.stack.imgur.com/SFysv.jpg";
            $course->rating = rand(1,5);
            $course->created_at = $time->format('Y-m-d H:i:s');
            $courseDetail = new CourseDetail();
            $courseDetail->material_id = uniqid();
            $courseDetail->course_id = $course->course_id;
            $courseDetail->course_title =  $faker->randomElement(['Learn Biologic','Who is Newton',"Learn Math","Introduce Programming","What is algorithm"]);
            $courseDetail->course_content = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam laboriosam mollitia quos? Ab rerum necessitatibus deserunt deleniti quas itaque accusantium, modi consequatur dolore recusandae qui dolor sequi voluptate optio! Earum!";
            $course->save();
            $courseDetail->save();
        }
    }
}
