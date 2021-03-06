<?php

/*
 * Copyright (c) 2011-2015 Lp digital system
 *
 * This file is part of BackBee.
 *
 * BackBee is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * BackBee is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with BackBee. If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Charles Rouillon <charles.rouillon@lp-digital.fr>
 */

namespace BackBee\Rest\Mapping;

use Metadata\MethodMetadata;

/**
 * Stores controller action metadata.
 *
 * @Annotation
 *
 * @category    BackBee
 *
 * @copyright   Lp digital system
 * @author      k.golovin
 */
class ActionMetadata extends MethodMetadata
{
    /**
     * @var array
     */
    public $queryParams = array();

    /**
     * @var array
     */
    public $requestParams = array();

    /**
     * @var integer
     */
    public $default_start;

    /**
     * @var integer
     */
    public $default_count;

    /**
     * @var integer
     */
    public $max_count;

    /**
     * @var integer
     */
    public $min_count;

    /**
     * @var array
     */
    public $param_converter_bag = array();

    /**
     * @var array
     */
    public $security = array();

    /**
     * serialize current object.
     *
     * @return string
     */
    public function serialize()
    {
        return \serialize([
            $this->class,
            $this->name,
            $this->queryParams,
            $this->requestParams,
            $this->default_start,
            $this->default_count,
            $this->max_count,
            $this->min_count,
            $this->param_converter_bag,
            $this->security,
        ]);
    }

    /**
     * unserialize.
     *
     * @param string $str
     */
    public function unserialize($str)
    {
        list(
            $this->class,
            $this->name,
            $this->queryParams,
            $this->requestParams,
            $this->default_start,
            $this->default_count,
            $this->max_count,
            $this->min_count,
            $this->param_converter_bag,
            $this->security
        ) = \unserialize($str);

        $this->reflection = new \ReflectionMethod($this->class, $this->name);
        $this->reflection->setAccessible(true);
    }
}
