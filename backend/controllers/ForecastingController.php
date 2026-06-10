<?php

namespace backend\controllers;

use common\models\Sale;
use common\models\Product;
use yii\web\Controller;

/**
 * ForecastingController generates forecasts for demand, sales, and stock.
 */
class ForecastingController extends Controller
{
    /**
     * Demand forecast - predicts future demand based on historical sales
     *
     * @return string
     */
    public function actionDemand()
    {
        $products = Product::find()->all();
        $forecastDays = 30; // Forecast next 30 days
        
        $productForecasts = [];

        foreach ($products as $product) {
            // Get last 30 days of sales for this product
            $thirtyDaysAgo = date('Y-m-d', strtotime('-30 days'));
            $sales = Sale::find()
                ->where(['product_id' => $product->product_id])
                ->where(['>=', 'sale_date', $thirtyDaysAgo . ' 00:00:00'])
                ->all();

            // Calculate average daily demand
            $totalQuantity = 0;
            foreach ($sales as $sale) {
                $totalQuantity += $sale->quantity_sold;
            }

            $averageDailyDemand = $totalQuantity > 0 ? $totalQuantity / 30 : 0;
            
            // Forecast for next 30 days
            $forecastedDemand = ceil($averageDailyDemand * $forecastDays);

            // Days of stock remaining
            $daysOfStockRemaining = $averageDailyDemand > 0 ? floor($product->stock_quantity / $averageDailyDemand) : 999;

            $productForecasts[] = [
                'product' => $product,
                'averageDailyDemand' => number_format($averageDailyDemand, 2),
                'forecastedDemand30Days' => $forecastedDemand,
                'daysOfStockRemaining' => $daysOfStockRemaining,
                'currentStock' => $product->stock_quantity,
                'recommendedRestockQuantity' => max(0, $forecastedDemand - $product->stock_quantity),
                'status' => $daysOfStockRemaining < 7 ? 'Urgent Restock' : ($daysOfStockRemaining < 14 ? 'Restock Soon' : 'Sufficient'),
            ];
        }

        return $this->render('demand', [
            'productForecasts' => $productForecasts,
            'forecastDays' => $forecastDays,
        ]);
    }

    /**
     * Sales forecast - predicts future sales revenue based on trends
     *
     * @return string
     */
    public function actionSalesForecast()
    {
        $days = 60; // Analyze last 60 days
        $forecastDays = 30; // Forecast next 30 days
        
        // Get sales data for the last 60 days
        $historicalSales = [];
        $totalRevenue = 0;
        $totalProfit = 0;

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $sales = Sale::find()
                ->where(['>=', 'sale_date', $date . ' 00:00:00'])
                ->where(['<', 'sale_date', date('Y-m-d', strtotime($date . ' +1 day')) . ' 00:00:00'])
                ->all();

            $dayRevenue = 0;
            $dayProfit = 0;

            foreach ($sales as $sale) {
                $dayRevenue += $sale->total_sale_price;
                $dayProfit += $sale->profit;
            }

            $totalRevenue += $dayRevenue;
            $totalProfit += $dayProfit;

            $historicalSales[] = [
                'date' => $date,
                'revenue' => $dayRevenue,
                'profit' => $dayProfit,
            ];
        }

        // Calculate averages
        $averageDailyRevenue = $days > 0 ? $totalRevenue / $days : 0;
        $averageDailyProfit = $days > 0 ? $totalProfit / $days : 0;

        // Forecast for next 30 days
        $forecastedRevenue = ceil($averageDailyRevenue * $forecastDays);
        $forecastedProfit = ceil($averageDailyProfit * $forecastDays);

        // Weekly breakdown of forecast
        $weeklyForecast = [];
        for ($week = 1; $week <= 4; $week++) {
            $weeklyForecast[] = [
                'week' => $week,
                'forecastedRevenue' => number_format($averageDailyRevenue * 7, 2),
                'forecastedProfit' => number_format($averageDailyProfit * 7, 2),
            ];
        }

        return $this->render('sales-forecast', [
            'historicalSales' => $historicalSales,
            'totalRevenue' => $totalRevenue,
            'totalProfit' => $totalProfit,
            'averageDailyRevenue' => number_format($averageDailyRevenue, 2),
            'averageDailyProfit' => number_format($averageDailyProfit, 2),
            'forecastedRevenue' => number_format($forecastedRevenue, 2),
            'forecastedProfit' => number_format($forecastedProfit, 2),
            'weeklyForecast' => $weeklyForecast,
            'forecastDays' => $forecastDays,
        ]);
    }

    /**
     * Stock forecast - predicts future stock levels
     *
     * @return string
     */
    public function actionStockForecast()
    {
        $products = Product::find()->all();
        $forecastDays = 30;
        
        $stockForecasts = [];

        foreach ($products as $product) {
            // Get sales data for last 30 days
            $thirtyDaysAgo = date('Y-m-d', strtotime('-30 days'));
            $sales = Sale::find()
                ->where(['product_id' => $product->product_id])
                ->where(['>=', 'sale_date', $thirtyDaysAgo . ' 00:00:00'])
                ->all();

            // Calculate average daily consumption
            $totalQuantity = 0;
            foreach ($sales as $sale) {
                $totalQuantity += $sale->quantity_sold;
            }

            $averageDailyConsumption = $totalQuantity > 0 ? $totalQuantity / 30 : 0;

            // Forecast stock level after 30 days
            $forecastedStockLevel = max(0, $product->stock_quantity - (int)($averageDailyConsumption * $forecastDays));

            // Will it run out?
            $daysUntilStockout = $averageDailyConsumption > 0 ? floor($product->stock_quantity / $averageDailyConsumption) : 999;
            $willRunOut = $forecastedStockLevel <= 0;

            // Recommended restock date
            $recommendedRestockDate = null;
            if ($daysUntilStockout < 15 && $daysUntilStockout > 0) {
                $recommendedRestockDate = date('Y-m-d', strtotime("+5 days")); // Restock in 5 days
            }

            $stockForecasts[] = [
                'product' => $product,
                'currentStock' => $product->stock_quantity,
                'averageDailyConsumption' => number_format($averageDailyConsumption, 2),
                'forecastedStockLevel' => $forecastedStockLevel,
                'daysUntilStockout' => $daysUntilStockout,
                'willRunOut' => $willRunOut,
                'recommendedRestockDate' => $recommendedRestockDate,
                'status' => $willRunOut ? 'URGENT!' : ($daysUntilStockout < 7 ? 'Soon' : 'Safe'),
            ];
        }

        // Sort by urgency
        usort($stockForecasts, function($a, $b) {
            return $a['daysUntilStockout'] <=> $b['daysUntilStockout'];
        });

        return $this->render('stock-forecast', [
            'stockForecasts' => $stockForecasts,
            'forecastDays' => $forecastDays,
        ]);
    }
}
