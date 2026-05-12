<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class Dashboard
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        return $this->chart->barChart()
            ->setTitle('San Francisco vs Boston.')
            ->setSubtitle('Wins during season 2021.')
            ->setGrid()
            ->addData([6, 9, 3, 4, 10, 8], 'Francisco')
            ->addData([7, 3, 8, 2, 6, 4], 'Boston')
            ->addData([7, 3, 8, 2, 6, 4], 'Wales')
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June'])
            ->setGrid();
    }
}
