<?php

namespace Database\Seeders;

use App\Models\Cinematography;
use App\Models\SubscriptionPlan;
use Database\Factories\SubscriptionPlanFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class SubscriptionPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->createSubscriptionPlans();
    	$this->syncSubscriptionPlansWithCinematographies();
    }

	protected function createSubscriptionPlans(): void
	{
		$this->subscriptionPlanFactory()->movie()->createOne();
		$this->subscriptionPlanFactory()->series()->createOne();
    }

	protected function syncSubscriptionPlansWithCinematographies(): void
	{
		$this->syncCinematographiesSubscriptionPlan(
			Cinematography::TYPE_MOVIE,
			SubscriptionPlanFactory::MOVIE_SUBSCRIPTION_PLAN_NAME
		);

		$this->syncCinematographiesSubscriptionPlan(
			Cinematography::TYPE_SERIES,
			SubscriptionPlanFactory::SERIES_SUBSCRIPTION_PLAN_NAME
		);
    }

	protected function syncCinematographiesSubscriptionPlan(string $cinematographyType, string $subscriptionPlanName): void
	{
		$cinematographies = $this->findCinematographiesByType($cinematographyType);

		foreach ($cinematographies as $cinematography) {
			$subscriptionPlan = $this->findSubscriptionPlanByName($subscriptionPlanName);

			$cinematography->subscriptionPlan()->sync([
				$subscriptionPlan->id
			]);
		}
	}

	/**
	 * Subscription plan factory.
	 *
	 * @return \Database\Factories\SubscriptionPlanFactory
	 */
	protected function subscriptionPlanFactory(): SubscriptionPlanFactory
	{
		return SubscriptionPlan::factory();
    }

	private function findCinematographiesByType(string $type): Collection
	{
		return Cinematography::where([
			'type' => $type
		])->get();
    }

	protected function findSubscriptionPlanByName(string $name): SubscriptionPlan
	{
		return SubscriptionPlan::where(['name' => $name])->firstOrFail();
    }
}
