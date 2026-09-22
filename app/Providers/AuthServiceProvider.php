<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Invoice;
use App\Policies\InvoicePolicy;
use App\Models\Client;
use App\Policies\ClientPolicy;
use App\Models\CompanySetting;
use App\Policies\CompanySettingPolicy;
use App\Models\Expense;
use App\Policies\ExpensePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Invoice::class => InvoicePolicy::class,
        Client::class => ClientPolicy::class,
        CompanySetting::class => CompanySettingPolicy::class,
        Expense::class => ExpensePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
