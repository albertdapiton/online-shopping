<?php

namespace Tests\Support;

use App\GraphQL\Queries\LoginQuery;
use App\GraphQL\Queries\UserQuery;
use App\GraphQL\Types\AccessTokenType;
use App\GraphQl\Types\ProfileType;
use App\GraphQl\Types\RoleType;
use App\GraphQL\Types\UserType;
use App\Models\User;
use App\Services\LoginService;
use GraphQL\Type\Schema;
use Illuminate\Support\Facades\Auth;
use Orchestra\Testbench\TestCase as BaseTestCase;
use PHPUnit\Framework\ExpectationFailedException;
use Rebing\GraphQL\GraphQLServiceProvider;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Tests\Support\Objects\LoginExampleQuery;
use Tests\Support\Objects\LoginExampleType;

abstract class TestCase extends BaseTestCase
{
    protected $queries;
    protected $data;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->data     = include __DIR__ . '/Objects/data.php';
        $this->queries  = include __DIR__ . '/Objects/queries.php';
        $this->results  = include __DIR__ . '/Objects/results.php';
    }

    protected function getEnvironmentSetUp($app)
    {   
        parent::getEnvironmentSetUp($app);

        if (env('TESTS_ENABLE_LAZYLOAD_TYPES') === '1') {
            $app['config']->set('graphql.lazyload_types', true);
        }
        
        $app['config']->set('graphql.schemas.login', [
            'query' => [
                LoginExampleQuery::class,
            ],
            'mutation' => [],
        ]);

        $app['config']->set('graphql.schemas.user', [
            'query' => [
                UserQuery::class,
            ],
            'mutation' => [],
        ]);

        $app['config']->set('graphql.types', [
            'AccessToken'   => AccessTokenType::class,
            'LoginExample'  => LoginExampleType::class,
            'Profile'       => ProfileType::class,
            'Role'          => RoleType::class,
            'User'          => UserType::class,
        ]);

        $app['config']->set('auth.providers.users', [
            'driver' => 'eloquent',
            'model' => User::class,
        ]);

        $app['config']->set('database.default', 'mysql');
        $app['config']->set('database.connections.mysql', [
            'driver' => 'mysql',
            'host' => 'mariadb',
            'port' => 3306,
            'database' => 'default',
            'username' => 'default',
            'password' => 'secret',
            'prefix' => '',
        ]);

        $app['config']->set('app.debug', true);
    }

    protected function getPackageProviders($app): array
    {
        $providers = [
            GraphQLServiceProvider::class,
        ];

        return $providers;
    }

    protected function getPackageAliases($app): array
    {
        return [
            'Auth'          => Auth::class,
            'GraphQL'       => GraphQL::class,
            'LoginService'  => LoginService::class,
            'User'          => User::class,
        ];
    }

    protected function assertGraphQLSchema($schema): void
    {
        $this->assertInstanceOf(Schema::class, $schema);
    }

     /**
     * Helper to dispatch an internal GraphQL requests.
     *
     * @param  string  $query
     * @param  array  $options
     *   Supports the following options:
     *   - `expectErrors` (default: false): if no errors are expected but present, let's the test fail
     *   - `variables` (default: null): GraphQL variables for the query
     * @return array GraphQL result
     */
    protected function graphql(string $query, array $options = []): array
    {
        $expectErrors = $options['expectErrors'] ?? false;
        $variables = $options['variables'] ?? null;

        $result = GraphQL::query($query, $variables, $options);

        $assertMessage = null;

        if (! $expectErrors && isset($result['errors'])) {
            $appendErrors = '';
            if (isset($result['errors'][0]['trace'])) {
                $appendErrors = "\n\n".$this->formatSafeTrace($result['errors'][0]['trace']);
            }

            $assertMessage = "Probably unexpected error in GraphQL response:\n"
                .var_export($result, true)
                .$appendErrors;
        }
        unset($result['errors'][0]['trace']);

        if ($assertMessage) {
            throw new ExpectationFailedException($assertMessage);
        }

        return $result;
    }

    /**
     * Helper to dispatch an HTTP GraphQL requests.
     *
     * @param  string  $query
     * @param  array  $options
     *   Supports the following options:
     *   - `httpStatusCode` (default: 200): the HTTP status code to expect
     * @return array GraphQL result
     */
    protected function httpGraphql(string $query, array $options = []): array
    {
        $expectedHttpStatusCode = $options['httpStatusCode'] ?? 200;

        $response = $this->call('GET', '/graphql', [
            'query' => $query,
        ]);

        $httpStatusCode = $response->getStatusCode();

        if ($expectedHttpStatusCode !== $httpStatusCode) {
            $result = $response->getData(true);
            $msg = var_export($result, true)."\n";
            $this->assertSame($expectedHttpStatusCode, $httpStatusCode, $msg);
        }

        return $response->getData(true);
    }

    /**
     * Converts the trace as generated from \GraphQL\Error\FormattedError::toSafeTrace
     * to a more human-readable string for a failed test.
     *
     * @param array $trace
     * @return string
     */
    private function formatSafeTrace(array $trace): string
    {
        return implode(
            "\n",
            array_map(function (array $row, int $index): string {
                $line = "#$index ";
                $line .= $row['file'] ?? '';
                if (isset($row['line'])) {
                    $line .= "({$row['line']}) :";
                }
                if (isset($row['call'])) {
                    $line .= ' '.$row['call'];
                }
                if (isset($row['function'])) {
                    $line .= ' '.$row['function'];
                }

                return $line;
            }, $trace, array_keys($trace))
        );
    }
}
