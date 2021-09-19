<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class EcommerceInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecom:install {--force : 許可を尋ねずに実行する}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ダミーデータを作成';

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
        if ($this->option('force')) {
            $this->proceed();
        } else {
            if ($this->confirm('現在のデータを全て削除してダミーデータを入れますか？')) {
                $this->proceed();
            }
        }
    }

        protected function proceed()
        {
            File::deleteDirectory(public_path('storage/products'));
            File::deleteDirectory(public_path('storage/settings'));
            File::deleteDirectory(public_path('storage/pages'));
            File::deleteDirectory(public_path('storage/posts'));
            File::deleteDirectory(public_path('storage/users'));
            
            $this->callSilent('storage:link');
            $fileSuccess = File::copyDirectory(public_path('img/products'), public_path('storage/products/dummy'));

            File::copyDirectory(public_path('img/pages'), public_path('storage/pages'));
            File::copyDirectory(public_path('img/posts'), public_path('storage/posts'));
            File::copyDirectory(public_path('img/users'), public_path('storage/users'));

            if ($fileSuccess) {
                $this->info('画像をstorageフォルダーにコピーしました');
            }
            $this->call('migrate:fresh', [
                '--seed' => true,
            ]);
            $this->call('db:seed', [
                '--class' => 'VoyagerDatabaseSeeder',
            ]);
            $this->call('db:seed', [
                '--class' => 'VoyagerDummyDatabaseSeeder',
            ]);
            $this->call('db:seed', [
                '--class' => 'DataTypesTableSeederCustom',
            ]);

            $this->call('db:seed', [
                '--class' => 'DataRowsTableSeederCustom',
            ]);

            $this->call('db:seed', [
                '--class' => 'MenusTableSeederCustom',
            ]);

            $this->call('db:seed', [
                '--class' => 'MenuItemsTableSeederCustom',
            ]);

            $this->call('db:seed', [
                '--class' => 'RolesTableSeederCustom',
            ]);

            $this->call('db:seed', [
                '--class' => 'PermissionsTableSeederCustom',
            ]);

            $this->call('db:seed', [
                '--class' => 'PermissionRoleTableSeeder',
            ]);

            $this->call('db:seed', [
                '--class' => 'PermissionRoleTableSeederCustom',
            ]);

            $this->call('db:seed', [
                '--class' => 'UsersTableSeeder',
            ]);

            $this->call('db:seed', [
                '--class' => 'UsersTableSeederCustom',
            ]);

            $this->info('データをインストールしました');
        }
}
