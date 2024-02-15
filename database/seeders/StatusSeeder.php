<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { {
            $statuses = ['Ongoing', 'Completed', 'Aborted', 'Suspended'];

            foreach ($statuses as $status) {

                $new_status = new Status();

                $new_status->title = $status;
                $new_status->slug = Str::of($status)->slug('-');

                $new_status->save();
            }
        }
    }
}
