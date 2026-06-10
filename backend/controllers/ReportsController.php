<?php

namespace backend\controllers;

use common\models\Sale;
use common\models\Product;
use common\models\StockAlert;
use common\models\Purchase;
use common\models\Expense;
use yii\web\Controller;

/**
 * ReportsController generates business reports and analytics.
 */
class ReportsController extends Controller
{
    /**
     * Dashboard with key business metrics.
     *
     * @return string
     */
    public function actionDashboard()
    {
        // Today's sales
        $todayDate = date('Y-m-d');
        $todayRevenue = Sale::find()
            ->where(['>=', 'sale_date', $todayDate . ' 00:00:00'])
            ->where(['<', 'sale_date', date('Y-m-d', strtotime('+1 day')) . ' 00:00:00'])
            ->sum('total_sale_price') ?? 0;

        $todayProfit = Sale::find()
            ->where(['>=', 'sale_date', $todayDate . ' 00:00:00'])
            ->where(['<', 'sale_date', date('Y-m-d', strtotime('+1 day')) . ' 00:00:00'])
            ->sum('profit') ?? 0;

        // This month
        $monthStart = date('Y-m-01');
        $monthEnd = date('Y-m-t');
        $monthRevenue = Sale::find()
            ->where(['>=', 'sale_date', $monthStart . ' 00:00:00'])
            ->where(['<=', 'sale_date', $monthEnd . ' 23:59:59'])
            ->sum('total_sale_price') ?? 0;

        $monthProfit = Sale::find()
            ->where(['>=', 'sale_date', $monthStart . ' 00:00:00'])
            ->where(['<=', 'sale_date', $monthEnd . ' 23:59:59'])
            ->sum('profit') ?? 0;

        // This year
        $yearStart = date('Y-01-01');
        $yearEnd = date('Y-12-31');
        $yearRevenue = Sale::find()
            ->where(['>=', 'sale_date', $yearStart . ' 00:00:00'])
            ->where(['<=', 'sale_date', $yearEnd . ' 23:59:59'])
            ->sum('total_sale_price') ?? 0;

        $yearProfit = Sale::find()
            ->where(['>=', 'sale_date', $yearStart . ' 00:00:00'])
            ->where(['<=', 'sale_date', $yearEnd . ' 23:59:59'])
            ->sum('profit') ?? 0;

        // Top products by profit
        $topProducts = $this->getTopProductsByProfit(5);

        // Alerts
        $activeAlerts = StockAlert::find()->where(['is_active' => 1])->count();

        // Total products
        $totalProducts = Product::find()->count();

        // Total expenses (month)
        $monthExpenses = Expense::find()
            ->where(['>=', 'expense_date', $monthStart . ' 00:00:00'])
            ->where(['<=', 'expense_date', $monthEnd . ' 23:59:59'])
            ->sum('amount') ?? 0;

        // Total purchases (month)
        $monthPurchases = Purchase::find()
            ->where(['>=', 'purchase_date', $monthStart . ' 00:00:00'])
            ->where(['<=', 'purchase_date', $monthEnd . ' 23:59:59'])
            ->sum('total_cost') ?? 0;

        return $this->render('dashboard', [
            'todayRevenue' => $todayRevenue,
            'todayProfit' => $todayProfit,
            'monthRevenue' => $monthRevenue,
            'monthProfit' => $monthProfit,
            'monthExpenses' => $monthExpenses,
            'monthPurchases' => $monthPurchases,
            'yearRevenue' => $yearRevenue,
            'yearProfit' => $yearProfit,
            'topProducts' => $topProducts,
            'activeAlerts' => $activeAlerts,
            'totalProducts' => $totalProducts,
        ]);
    }

    /**
     * Daily report.
     *
     * @return string
     */
    public function actionDaily()
    {
        $date = \Yii::$app->request->get('date', date('Y-m-d'));

        $sales = Sale::find()
            ->where(['>=', 'sale_date', $date . ' 00:00:00'])
            ->where(['<', 'sale_date', date('Y-m-d', strtotime($date . ' +1 day')) . ' 00:00:00'])
            ->orderBy(['sale_date' => SORT_DESC])
            ->all();

        $totalRevenue = Sale::find()
            ->where(['>=', 'sale_date', $date . ' 00:00:00'])
            ->where(['<', 'sale_date', date('Y-m-d', strtotime($date . ' +1 day')) . ' 00:00:00'])
            ->sum('total_sale_price') ?? 0;

        $totalProfit = Sale::find()
            ->where(['>=', 'sale_date', $date . ' 00:00:00'])
            ->where(['<', 'sale_date', date('Y-m-d', strtotime($date . ' +1 day')) . ' 00:00:00'])
            ->sum('profit') ?? 0;

        return $this->render('daily', [
            'sales' => $sales,
            'date' => $date,
            'totalRevenue' => $totalRevenue,
            'totalProfit' => $totalProfit,
        ]);
    }

    /**
     * Weekly report.
     *
     * @return string
     */
    public function actionWeekly()
    {
        $date = \Yii::$app->request->get('date', date('Y-m-d'));
        $weekStart = date('Y-m-d', strtotime('monday this week', strtotime($date)));
        $weekEnd = date('Y-m-d', strtotime('sunday this week', strtotime($date)));

        $sales = Sale::find()
            ->where(['>=', 'sale_date', $weekStart . ' 00:00:00'])
            ->where(['<=', 'sale_date', $weekEnd . ' 23:59:59'])
            ->orderBy(['sale_date' => SORT_DESC])
            ->all();

        $totalRevenue = Sale::find()
            ->where(['>=', 'sale_date', $weekStart . ' 00:00:00'])
            ->where(['<=', 'sale_date', $weekEnd . ' 23:59:59'])
            ->sum('total_sale_price') ?? 0;

        $totalProfit = Sale::find()
            ->where(['>=', 'sale_date', $weekStart . ' 00:00:00'])
            ->where(['<=', 'sale_date', $weekEnd . ' 23:59:59'])
            ->sum('profit') ?? 0;

        return $this->render('weekly', [
            'sales' => $sales,
            'weekStart' => $weekStart,
            'weekEnd' => $weekEnd,
            'totalRevenue' => $totalRevenue,
            'totalProfit' => $totalProfit,
        ]);
    }

    /**
     * Monthly report.
     *
     * @return string
     */
    public function actionMonthly()
    {
        $month = \Yii::$app->request->get('month', date('Y-m'));
        $monthStart = $month . '-01';
        $monthEnd = date('Y-m-t', strtotime($monthStart));

        $sales = Sale::find()
            ->where(['>=', 'sale_date', $monthStart . ' 00:00:00'])
            ->where(['<=', 'sale_date', $monthEnd . ' 23:59:59'])
            ->orderBy(['sale_date' => SORT_DESC])
            ->all();

        $totalRevenue = Sale::find()
            ->where(['>=', 'sale_date', $monthStart . ' 00:00:00'])
            ->where(['<=', 'sale_date', $monthEnd . ' 23:59:59'])
            ->sum('total_sale_price') ?? 0;

        $totalProfit = Sale::find()
            ->where(['>=', 'sale_date', $monthStart . ' 00:00:00'])
            ->where(['<=', 'sale_date', $monthEnd . ' 23:59:59'])
            ->sum('profit') ?? 0;

        return $this->render('monthly', [
            'sales' => $sales,
            'month' => $month,
            'monthStart' => $monthStart,
            'monthEnd' => $monthEnd,
            'totalRevenue' => $totalRevenue,
            'totalProfit' => $totalProfit,
        ]);
    }

    /**
     * Yearly report.
     *
     * @return string
     */
    public function actionYearly()
    {
        $year = \Yii::$app->request->get('year', date('Y'));
        $yearStart = $year . '-01-01';
        $yearEnd = $year . '-12-31';

        $sales = Sale::find()
            ->where(['>=', 'sale_date', $yearStart . ' 00:00:00'])
            ->where(['<=', 'sale_date', $yearEnd . ' 23:59:59'])
            ->orderBy(['sale_date' => SORT_DESC])
            ->all();

        $totalRevenue = 0;
        $totalProfit = 0;
        foreach ($sales as $sale) {
            $totalRevenue += $sale->total_sale_price;
            $totalProfit += $sale->profit;
        }

        return $this->render('yearly', [
            'sales' => $sales,
            'year' => $year,
            'totalRevenue' => $totalRevenue,
            'totalProfit' => $totalProfit,
        ]);
    }

    /**
     * Product analysis - shows profit by product.
     *
     * @return string
     */
    public function actionProductAnalysis()
    {
        $products = Product::find()->all();
        
        $productData = [];
        foreach ($products as $product) {
            $sales = Sale::find()->where(['product_id' => $product->product_id])->all();
            
            $totalQuantity = 0;
            $totalProfit = 0;
            foreach ($sales as $sale) {
                $totalQuantity += $sale->quantity_sold;
                $totalProfit += $sale->profit;
            }

            $productData[] = [
                'product' => $product,
                'totalQuantity' => $totalQuantity,
                'totalProfit' => $totalProfit,
                'currentStock' => $product->stock_quantity,
                'profitMargin' => $product->getProfitMargin(),
            ];
        }

        // Sort by profit descending
        usort($productData, function($a, $b) {
            return $b['totalProfit'] <=> $a['totalProfit'];
        });

        return $this->render('product-analysis', [
            'productData' => $productData,
        ]);
    }

    /**
     * Inventory value report - shows total inventory value in store
     *
     * @return string
     */
    public function actionInventoryValue()
    {
        $products = Product::find()->all();
        
        $totalInventoryValue = 0;
        $totalInventoryCost = 0;
        $productData = [];

        foreach ($products as $product) {
            $inventoryValue = $product->stock_quantity * $product->selling_price;
            $inventoryCost = $product->stock_quantity * $product->cost_price;
            $potentialProfit = $product->getPotentialProfit();

            $totalInventoryValue += $inventoryValue;
            $totalInventoryCost += $inventoryCost;

            $productData[] = [
                'product' => $product,
                'inventoryValue' => $inventoryValue,
                'inventoryCost' => $inventoryCost,
                'potentialProfit' => $potentialProfit,
                'stockQuantity' => $product->stock_quantity,
            ];
        }

        return $this->render('inventory-value', [
            'productData' => $productData,
            'totalInventoryValue' => $totalInventoryValue,
            'totalInventoryCost' => $totalInventoryCost,
            'totalPotentialProfit' => $totalInventoryValue - $totalInventoryCost,
        ]);
    }

    /**
     * Sales trends report - shows sales performance over time
     *
     * @return string
     */
    public function actionSalesTrends()
    {
        $days = 30; // Last 30 days
        $salesByDay = [];
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
            $dayQuantity = 0;

            foreach ($sales as $sale) {
                $dayRevenue += $sale->total_sale_price;
                $dayProfit += $sale->profit;
                $dayQuantity += $sale->quantity_sold;
            }

            $totalRevenue += $dayRevenue;
            $totalProfit += $dayProfit;

            $salesByDay[] = [
                'date' => $date,
                'revenue' => $dayRevenue,
                'profit' => $dayProfit,
                'quantity' => $dayQuantity,
                'salesCount' => count($sales),
            ];
        }

        $averageDailyRevenue = $days > 0 ? $totalRevenue / $days : 0;
        $averageDailyProfit = $days > 0 ? $totalProfit / $days : 0;

        return $this->render('sales-trends', [
            'salesByDay' => $salesByDay,
            'totalRevenue' => $totalRevenue,
            'totalProfit' => $totalProfit,
            'averageDailyRevenue' => $averageDailyRevenue,
            'averageDailyProfit' => $averageDailyProfit,
        ]);
    }

    /**
     * Profit and Loss report
     *
     * @return string
     */
    public function actionProfitLoss()
    {
        $month = \Yii::$app->request->get('month', date('Y-m'));
        $monthStart = $month . '-01';
        $monthEnd = date('Y-m-t', strtotime($monthStart));

        // Sales revenue
        $sales = Sale::find()
            ->where(['>=', 'sale_date', $monthStart . ' 00:00:00'])
            ->where(['<=', 'sale_date', $monthEnd . ' 23:59:59'])
            ->all();

        $totalRevenue = 0;
        $totalProfit = 0;
        foreach ($sales as $sale) {
            $totalRevenue += $sale->total_sale_price;
            $totalProfit += $sale->profit;
        }

        // Expenses
        $expenses = Expense::find()
            ->where(['>=', 'expense_date', $monthStart . ' 00:00:00'])
            ->where(['<=', 'expense_date', $monthEnd . ' 23:59:59'])
            ->all();

        $totalExpenses = 0;
        foreach ($expenses as $expense) {
            $totalExpenses += $expense->amount;
        }

        // Net profit
        $netProfit = $totalProfit - $totalExpenses;

        return $this->render('profit-loss', [
            'month' => $month,
            'totalRevenue' => $totalRevenue,
            'totalProfit' => $totalProfit,
            'totalExpenses' => $totalExpenses,
            'netProfit' => $netProfit,
            'expenses' => $expenses,
        ]);
    }

    /**
     * Get top products by profit.
     *
     * @param int $limit
     * @return array
     */
    private function getTopProductsByProfit($limit = 5)
    {
        $products = Product::find()->all();
        
        $productData = [];
        foreach ($products as $product) {
            $sales = Sale::find()->where(['product_id' => $product->product_id])->all();
            
            $totalProfit = 0;
            foreach ($sales as $sale) {
                $totalProfit += $sale->profit;
            }

            $productData[] = [
                'product' => $product,
                'totalProfit' => $totalProfit,
            ];
        }

        // Sort by profit descending and limit
        usort($productData, function($a, $b) {
            return $b['totalProfit'] <=> $a['totalProfit'];
        });

        return array_slice($productData, 0, $limit);
    }
}
