<?php

namespace App\Console\Commands;

use App\Models\Backend\Admin;
use Illuminate\Console\Command;

class AdminAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:creat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Admin $admin)
    {
        $name = 'admin' . random_int(1,10000);
        $pass = bcrypt('admin123456');
        $mail = 'admin' . random_int(1, 10000) . '@gmail.com';

        $create = new $admin;

        $create->name = $name;
        $create->password = $pass;
        $create->email = $mail;

        $create->save();

        echo 'ten admin: ' . $name . '  email la:' . $mail . '   pass la: admin123456';
    }
}
