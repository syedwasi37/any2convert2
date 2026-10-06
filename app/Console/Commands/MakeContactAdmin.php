<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeContactAdmin extends Command
{
    protected $signature = 'contact:make-admin {email : Email address of an existing account}';

    protected $description = 'Grant the contact inbox administrator access to an existing user';

    public function handle(): int
    {
        $user = User::where('email', mb_strtolower(trim((string) $this->argument('email'))))->first();
        if (! $user) {
            $this->components->error('No account exists for that email. Create the account first, then run this command again.');

            return self::FAILURE;
        }

        $user->forceFill(['is_admin' => true])->save();
        $this->components->info("{$user->email} can now manage the contact inbox at /admin/contact.");

        return self::SUCCESS;
    }
}
