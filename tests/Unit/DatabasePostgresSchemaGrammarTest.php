<?php

namespace PowerLabs-NZ\EloquentEncryption\Tests\Unit;

use Illuminate\Database\Schema\Grammars\PostgresGrammar;
use Mockery;
use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Blueprint;
use PowerLabs-NZ\EloquentEncryption\Tests\TestCase;

class DatabasePostgresSchemaGrammarTest extends TestCase
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
            ['alter table "users" add column "foo" bytea not null'],
            $blueprint->toSql($connection, new PostgresGrammar)
        );
    }
}
