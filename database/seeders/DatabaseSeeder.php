<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\PaymentPackage;
use App\Models\Setting;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user1 = new User();
        $user1->name = "thusitha";
        $user1->email = "thusitha@gmail.com";
        $user1->password = bcrypt('12345678');
        $teacher1 = new Teacher();
        $teacher1->status = true;
        $teacher1->level = 4;
        $teacher1->save();
        $teacher1->user()->save($user1);

        $user4 = new User();
        $user4->name = "Kavidu";
        $user4->email = "kavidu@gmail.com";
        $user4->password = bcrypt('12345678');
        $teacher2 = new Teacher();
        $teacher2->status = true;
        $teacher2->level = 4;
        $teacher2->save();
        $teacher2->user()->save($user4);

        $user5 = new User();
        $user5->name = "Kalpana";
        $user5->email = "kalpana@gmail.com";
        $user5->password = bcrypt('12345678');
        $teacher3 = new Teacher();
        $teacher3->status = true;
        $teacher3->level = 4;
        $teacher3->save();
        $teacher3->user()->save($user5);

        $user6 = new User();
        $user6->name = "Tharaka";
        $user6->email = "tharaka@gmail.com";
        $user6->password = bcrypt('12345678');
        $teacher4 = new Teacher();
        $teacher4->status = true;
        $teacher4->level = 4;
        $teacher4->save();
        $teacher4->user()->save($user6);

        $user2 = new User();
        $user2->name = "dinesh";
        $user2->email = "dinesh@gmail.com";
        $user2->password = bcrypt('12345678');
        $student1 = new Student();
        $student1->status = true;
        $student1->save();
        $student1->user()->save($user2);

        $user3 = new User();
        $user3->name = "gaveen";
        $user3->email = "gaveen@gmail.com";
        $user3->password = bcrypt('12345678');
        $admin1 = new Admin();
        $admin1->save();
        $admin1->user()->save($user3);

        $setting=  new Setting();
        $setting->commission = 0;
        $setting->payout_limit = 100;
        $setting->streaming_amount = 5;
        $setting->paid_level = 4;
        $setting->save();

        $payment_package = new PaymentPackage();
        $payment_package->name="Premium";
        $payment_package->streaming_count=5;
        $payment_package->description="Description";
        $payment_package->price=100;
        $payment_package->color="#ff0000";
        $payment_package->status=1;
        $payment_package->save();
    }
}
