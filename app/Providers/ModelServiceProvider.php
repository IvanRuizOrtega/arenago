<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

final class ModelServiceProvider extends ServiceProvider
{
	public function register(): void
	{
	}

	public function boot(): void
	{
		$this->searchBy();
		$this->searchByWithRelations();
	}

	private function searchBy()
	{
		Builder::macro("searchBy", function ($search, ...$attributes) {
			if (!empty($search)) {
				foreach ($attributes as $attribute) {
					$this->orWhere(
						$attribute,
						"LIKE",
						"%{$search}%"
					);
				}
			}
			return $this;
		});
	}

	private function searchByWithRelations()
	{
		Builder::macro("searchByWithRelations", function ($search, ...$attributes) {
			if (!empty($search)) {
				$this->where(function (Builder $query) use ($attributes, $search) {
					foreach ($attributes as $attribute) {
						$query->when(
							str_contains($attribute, "."),
							function (Builder $query) use ($attribute, $search) {
								[$relationName, $relationAttribute] = explode(".", $attribute);
								$query->orWhereHas(
									$relationName,
									function (Builder $query) use ($relationAttribute, $search) {
										$query->where(
											$relationAttribute,
											"LIKE",
											"%{$search}%"
										);
									}
								);
							},
							function (Builder $query) use ($attribute, $search) {
								$query->orWhere($attribute, "LIKE", "%{$search}%");
							}
						);
					}
				});
			}
			return $this;
		});
	}
}

