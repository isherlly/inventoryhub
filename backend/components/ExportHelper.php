<?php

namespace backend\components;

use common\models\Sale;
use common\models\Purchase;
use common\models\Expense;
use yii\base\Component;

class ExportHelper extends Component
{
    /**
     * Export sales data to CSV
     */
    public static function exportSalesCSV($startDate = null, $endDate = null)
    {
        $query = Sale::find();
        
        if ($startDate && $endDate) {
            $query->where(['>=', 'sale_date', $startDate . ' 00:00:00'])
                  ->andWhere(['<=', 'sale_date', $endDate . ' 23:59:59']);
        }

        $sales = $query->all();

        $filename = 'sales_' . date('Y-m-d-H-i-s') . '.csv';
        $filepath = \Yii::getAlias('@runtime') . '/' . $filename;

        $file = fopen($filepath, 'w');
        
        // Headers
        fputcsv($file, ['Sale ID', 'Product', 'Customer', 'Quantity', 'Unit Price', 'Total Price', 'Profit', 'Date']);

        // Data
        foreach ($sales as $sale) {
            fputcsv($file, [
                $sale->sale_id,
                $sale->product->product_name ?? 'N/A',
                $sale->customer_name,
                $sale->quantity_sold,
                $sale->selling_price,
                $sale->total_sale_price,
                $sale->profit,
                $sale->sale_date,
            ]);
        }

        fclose($file);
        return $filepath;
    }

    /**
     * Export purchases data to CSV
     */
    public static function exportPurchasesCSV($startDate = null, $endDate = null)
    {
        $query = Purchase::find();
        
        if ($startDate && $endDate) {
            $query->where(['>=', 'purchase_date', $startDate . ' 00:00:00'])
                  ->andWhere(['<=', 'purchase_date', $endDate . ' 23:59:59']);
        }

        $purchases = $query->all();

        $filename = 'purchases_' . date('Y-m-d-H-i-s') . '.csv';
        $filepath = \Yii::getAlias('@runtime') . '/' . $filename;

        $file = fopen($filepath, 'w');
        
        // Headers
        fputcsv($file, ['Purchase ID', 'Supplier', 'Product', 'Quantity', 'Unit Price', 'Total Cost', 'Date']);

        // Data
        foreach ($purchases as $purchase) {
            fputcsv($file, [
                $purchase->purchase_id,
                $purchase->supplier->supplier_name ?? 'N/A',
                $purchase->product->product_name ?? 'N/A',
                $purchase->quantity_purchased,
                $purchase->unit_price,
                $purchase->total_cost,
                $purchase->purchase_date,
            ]);
        }

        fclose($file);
        return $filepath;
    }

    /**
     * Export expenses data to CSV
     */
    public static function exportExpensesCSV($startDate = null, $endDate = null)
    {
        $query = Expense::find();
        
        if ($startDate && $endDate) {
            $query->where(['>=', 'expense_date', $startDate . ' 00:00:00'])
                  ->andWhere(['<=', 'expense_date', $endDate . ' 23:59:59']);
        }

        $expenses = $query->all();

        $filename = 'expenses_' . date('Y-m-d-H-i-s') . '.csv';
        $filepath = \Yii::getAlias('@runtime') . '/' . $filename;

        $file = fopen($filepath, 'w');
        
        // Headers
        fputcsv($file, ['Expense ID', 'Type', 'Description', 'Amount', 'Date']);

        // Data
        foreach ($expenses as $expense) {
            fputcsv($file, [
                $expense->expense_id,
                $expense->expense_type,
                $expense->description,
                $expense->amount,
                $expense->expense_date,
            ]);
        }

        fclose($file);
        return $filepath;
    }
}
