<?php

/*
 * This file is part of the sxbrsky/database.
 *
 * Copyright (C) 2024 Dominik Szamburski
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Sxbrsky\Tests\Unit;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Sxbrsky\Tests\Stubs\DummyDriver;
use Sxbrsky\Database\Driver;
use Sxbrsky\Database\Driver\DriverManager;
use Sxbrsky\Database\Driver\DriverManagerInterface;

#[CoversClass(DriverManager::class)]
class DriverManagerTest extends TestCase
{
    private DriverManagerInterface $driverManager;

    public function setUp(): void
    {
        $this->driverManager = new DriverManager();
    }

    public function testGetThrowsExceptionWhileGetUnregisteredDriver(): void
    {
        self::expectException(\RuntimeException::class);
        self::expectExceptionMessage("Driver 'dummy-driver' was not registered.");

        $this->driverManager->get('dummy-driver');
    }

    public function testAdd(): void
    {
        $this->driverManager->add('dummy-driver', DummyDriver::class);
        self::assertInstanceOf(Driver::class, $this->driverManager->get('dummy-driver'));
    }

    public function testRegisterThrowsExceptionWhileOverride(): void
    {
        self::expectException(\LogicException::class);
        self::expectExceptionMessage("Driver 'dummy-driver' is already registered.");

        $this->driverManager->add('dummy-driver', DummyDriver::class);
        $this->driverManager->add('dummy-driver', DummyDriver::class);
    }

    public function testRemove(): void
    {
        $this->driverManager->add('dummy-driver', DummyDriver::class);
        $this->driverManager->remove('dummy-driver');

        self::assertEmpty($this->driverManager->all());
    }

    public function testAll(): void
    {
        $this->driverManager->add('dummy-driver', DummyDriver::class);
        self::assertCount(1, $this->driverManager->all());
    }
}
