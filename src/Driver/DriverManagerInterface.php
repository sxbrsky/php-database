<?php

/*
 * This file is part of the sxbrsky/database.
 *
 * Copyright (C) 2024 Dominik Szamburski
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Sxbrsky\Database\Driver;

interface DriverManagerInterface
{
    /**
     * Retrieves all registered drivers.
     *
     * @return string[]
     *  The registered drivers.
     */
    public function all(): array;

    /**
     * Retrieves a driver by its name.
     *
     * @param string $name
     *  The name of the driver to retrieve
     *
     * @return \Sxbrsky\Database\Driver
     *  The driver associated with the given name.
     */
    public function get(string $name): \Sxbrsky\Database\Driver;

    /**
     * Adds a new driver.
     *
     * @param string $name
     *  The name of the driver.
     * @param class-string<\Sxbrsky\Database\Driver> $driverClass
     *  The driver class to register.
     */
    public function add(string $name, string $driverClass): void;

    /**
     * Removes a driver.
     *
     * @param string $name
     *  The name of the driver to unregister.
     */
    public function remove(string $name): void;
}
