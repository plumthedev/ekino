<?php

namespace Database\Seeders;

use App\Models\Role;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Services\MediaGenerator\Contracts\Service as MediaGenerator;
use Database\Factories\UserFactory;

class UsersSeeder extends Seeder
{
    /**
     * Image generator.
     *
     * @var \App\Services\MediaGenerator\Contracts\Service
     */
    protected $mediaGenerator;

    /**
     * Faker generator.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Seeder constructor.
     *
     * @param \App\Services\MediaGenerator\Contracts\Service $mediaGenerator
     * @param \Faker\Generator                               $faker
     */
    public function __construct(MediaGenerator $mediaGenerator, Faker $faker)
    {
        $this->mediaGenerator = $mediaGenerator;
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::withoutEvents(function () {
            $this->createUsers();
            $this->createUsersMedia();
            $this->assignRoleToUsers();
        });
    }
    /**
     * Assign role to users.
     *
     * @return void
     */
    protected function assignRoleToUsers(): void
    {
        foreach (User::all() as $user) {
            $role = Role::firstOrCreate(['name' => Role::USER]);
            $user->assignRole($role);
        }
    }


    /**
     * Create users.
     *
     * @return void
     */
    protected function createUsers(): void
    {
        $this->userFactory()->count(5)->create();
        $this->userFactory()->nameless()->count(5)->create();
        $this->userFactory()->notVerified()->count(5)->create();
    }

    /**
     * Create users media.
     *
     * @return void
     */
    protected function createUsersMedia(): void
    {
        foreach (User::all() as $user) {
            if ($this->faker->boolean) {
                $this->addUserProfilePicture($user);
            }
        }
    }

    /**
     * Add user profile picture.
     *
     * @param \App\Models\User $user
     *
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    protected function addUserProfilePicture(User $user): void
    {
        $profilePicture = $this->mediaGenerator->personImage()->getMedia();

        $user
            ->addMedia($profilePicture)
            ->toMediaCollection(User::MEDIA_COLLECTION_PROFILE_PICTURE);
    }

    /**
     * Return user factory instance.
     *
     * @return \Database\Factories\UserFactory
     */
    protected function userFactory(): UserFactory
    {
        return User::factory();
    }
}
