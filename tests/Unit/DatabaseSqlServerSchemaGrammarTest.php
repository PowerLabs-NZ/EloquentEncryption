<?php

namespace PowerLabs\EloquentEncryption\Tests\Unit;

use Illuminate\Database\Schema\Grammars\SqlServerGrammar;
use Mockery;
use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Blueprint;
use PowerLabs\EloquentEncryption\Tests\TestCase;

class DatabaseSqlServerSchemaGrammarTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testAddingEncryptedColumn()
    {
        $blueprint = new Blueprint('users', function ($table) {
            $table->encrypted('foo');
        });

        $connection = Mockery::mock(Connection::class);

        $this->assertEquals(
            ['alter table "users" add "foo" varbinary(max) not null'],
            $blueprint->toSql($connection, new SqlServerGrammar)
        );
    }
}
