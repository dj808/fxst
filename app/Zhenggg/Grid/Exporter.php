<?php

namespace App\Zhenggg\Grid;

use App\Zhenggg\Grid;
use App\Zhenggg\Grid\Exporters\CsvExporter;

class Exporter
{
    /**
     * @var Grid
     */
    protected $grid;

    /**
     * Available exporter drivers.
     *
     * @var array
     */
    protected static $drivers = [];

    /**
     * Export query name.
     *
     * @var string
     */
    public static $queryName = '_export_';

    /**
     * Create a new Exporter instance.
     *
     * @param Grid $grid
     */
    public function __construct(Grid $grid)
    {
        $this->grid = $grid;

        $this->grid->model()->usePaginate(false);
    }

    /**
     * Set export query name.
     *
     * @param $name
     */
    public static function setQueryName($name)
    {
        static::$queryName = $name;
    }

    /**
     * Extends new exporter driver.
     *
     * @param $driver
     * @param $extend
     */
    public static function extend($driver, $extend)
    {
        static::$drivers[$driver] = $extend;
    }

    /**
     * Resolve export driver.
     *
     * @param string $driver
     *
     * @return CsvExporter
     */
    public function resolve($driver)
    {
        if ($driver instanceof Grid\Exporters\AbstractExporter) {
            return $driver->setGrid($this->grid);
        }

        return $this->getExporter($driver);
    }

    /**
     * Get export driver.
     *
     * @param string $driver
     *
     * @return CsvExporter
     */
    protected function getExporter($driver)
    {
        if (!array_key_exists($driver, static::$drivers)) {
            return $this->getDefaultExporter();
        }

        return new static::$drivers[$driver]($this->grid);
    }

    /**
     * Get default exporter.
     *
     * @return CsvExporter
     */
    public function getDefaultExporter()
    {
        return new CsvExporter($this->grid);
    }
}
