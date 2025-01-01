namespace Cyrox\Chatbot;

use Illuminate\Support\ServiceProvider;

class ChatbotServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Automatically load migrations
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');

        // Publish migrations to the application's migration folder
        $this->publishes([
            __DIR__ . '/Database/migrations' => database_path('migrations'),
        ], 'chatbot-migrations');

        // Publish assets (public-facing files) to the application's public folder
        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/cyrox/chatbot'),
        ], 'cyrox-chatbot-assets');

        // Load and publish views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'chatbot');
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/cyrox/chatbot'),
        ], 'chatbot-views');

        // Publish the config file (chatbot.php)
        $this->publishes([
            __DIR__ . '/../config/chatbot.php' => config_path('chatbot.php'),
        ], 'chatbot-config');

        // Load package routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Merge package configuration with the application's config
        $this->mergeConfigFrom(
            __DIR__ . '/../config/chatbot.php', 'chatbot'
        );

        // Ensure the configuration file is accessible globally
        $this->mergeConfigFrom(
            __DIR__ . '/../config/chatbot.php', 'chatbot.openai'
        );
    }
}
