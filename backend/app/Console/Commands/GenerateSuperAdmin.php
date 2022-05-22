<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GenerateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:super-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is create a super admin for the system.';

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
     * @return mixed
     */
    public function handle()
    {

        // Get the inputs
        $name     = $this->ask('Please input user name');
        $email    = $this->ask('Please input email');
        $password = $this->secret('Please input password');
        $confirm  = $this->secret('Please confirm password');

        // Validate the inputs
        $validator = Validator::make([
            'name'                  => $name,
            'email'                 => $email,
            'password'              => $password,
            'password_confirmation' => $confirm,
        ], [
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:4', 'confirmed'],
        ]);

        // Return validation errors
        if ($validator->fails()) {
            $this->info('Super admin is not created. See error messages below:');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

        // Create super admin
        DB::transaction(function () use ($name, $email, $password) {
            $admin = User::create([
                'name'      => $name,
                'email'     => $email,
                'password'  => bcrypt($password),
            ]);
        });

        $this->info('Super Admin created successfully.');

        return 0;
    }
}
