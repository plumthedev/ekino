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

	/**
	 * Create basics subscription plans.
	 *
	 * @return void
	 */
	protected function createSubscriptionPlans(): void
	{
		$this->subscriptionPlanFactory()->movie()->createOne();
		$this->subscriptionPlanFactory()->series()->createOne();
	}

	/**
	 * Synchronise subscription plans with cinematographies.
	 * Find cinematographies by type and synchronise with subscription plan by name.
	 *
	 * @return void
	 */
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

	/**
	 * Find cinematographies by type and synchronise with subscription plan by name.
	 *
	 * @param string $cinematographyType
	 * @param string $subscriptionPlanName
	 *
	 * @return void
	 */
	protected function syncCinematographiesSubscriptionPlan(string $cinematographyType, string $subscriptionPlanName): void
	{
		$cinematographies = $this->findCinematographiesByType($cinematographyType);

		foreach ($cinematographies as $cinematography) {
			$subscriptionPlan = $this->findSubscriptionPlanByName($subscriptionPlanName);
			$cinematography = $cinematography->subscriptionPlan()->associate($subscriptionPlan);

			$cinematography->save();
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

	/**
	 * Find cinematographies by type.
	 *
	 * @param string $type
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	private function findCinematographiesByType(string $type): Collection
	{
		return Cinematography::where(['type' => $type])->get();
	}

	/**
	 * Find subscription plan by name.
	 *
	 * @param string $name
	 *
	 * @return \App\Models\SubscriptionPlan
	 */
	protected function findSubscriptionPlanByName(string $name): SubscriptionPlan
	{
		return SubscriptionPlan::where(['name' => $name])->firstOrFail();
	}
}
