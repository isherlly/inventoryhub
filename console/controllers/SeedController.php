<?php

namespace console\controllers;

use common\models\Product;
use common\models\Sale;
use common\models\Customer;
use Yii;
use yii\console\Controller;

class SeedController extends Controller
{
    public function actionAll()
    {
        echo "🌱 Creating sample data...\n";
        
        $this->actionProducts();
        $this->actionCustomers();
        $this->actionSales();
        
        echo "\n✅ Sample data created successfully!\n";
    }

    public function actionProducts()
    {
        echo "📦 Creating products...\n";
        
        $products = [
            ['Rice', 'Grains', 5000, 7000, 100, 10, 'Premium long grain rice'],
            ['Beans', 'Legumes', 3500, 5000, 80, 8, 'High quality beans'],
            ['Flour', 'Grains', 2000, 3000, 150, 15, 'All-purpose flour'],
            ['Sugar', 'Sweeteners', 4500, 6500, 60, 5, 'White granulated sugar'],
            ['Oil', 'Cooking', 8000, 11000, 40, 5, 'Premium vegetable oil'],
            ['Salt', 'Seasonings', 1000, 1500, 200, 20, 'Table salt'],
            ['Soap', 'Toiletries', 1500, 2500, 120, 10, 'Bar soap'],
            ['Milk', 'Dairy', 3000, 4500, 50, 5, 'Fresh milk powder'],
            ['Bread', 'Bakery', 1200, 2000, 80, 10, 'White bread'],
            ['Egg', 'Protein', 50, 100, 300, 30, 'Fresh eggs per piece'],
        ];

        foreach ($products as $p) {
            $product = new Product();
            $product->product_name = $p[0];
            $product->category = $p[1];
            $product->cost_price = $p[2];
            $product->selling_price = $p[3];
            $product->stock_quantity = $p[4];
            $product->min_stock_level = $p[5];
            $product->description = $p[6];
            
            if ($product->save()) {
                echo "  ✓ {$p[0]} added\n";
            } else {
                echo "  ✗ {$p[0]} failed: " . json_encode($product->errors) . "\n";
            }
        }
    }

    public function actionCustomers()
    {
        echo "👥 Creating customers...\n";
        
        $customers = [
            ['Adekunle Shops', '08012345678', 'adekunle@shop.com', 'Ikeja', 'Lagos'],
            ['Mama Bisi Store', '08087654321', 'mama.bisi@mail.com', 'Lekki', 'Lagos'],
            ['John Trading Co', '09012345678', 'john@trading.com', 'VI', 'Lagos'],
            ['Grace Supermarket', '09087654321', 'grace@supermart.com', 'Ajah', 'Lagos'],
            ['Emmanuel Wholesale', '08123456789', 'emmanuel@wholesale.com', 'Yaba', 'Lagos'],
        ];

        foreach ($customers as $c) {
            $customer = new Customer();
            $customer->customer_name = $c[0];
            $customer->phone = $c[1];
            $customer->email = $c[2];
            $customer->city = $c[3];
            $customer->address = $c[4];
            
            if ($customer->save()) {
                echo "  ✓ {$c[0]} added\n";
            }
        }
    }

    public function actionSales()
    {
        echo "💰 Creating sample sales...\n";
        
        $products = Product::find()->all();
        $customers = Customer::find()->all();
        
        if (empty($products) || empty($customers)) {
            echo "  ✗ No products or customers found!\n";
            return;
        }

        // Create sales for the last 30 days
        for ($day = 0; $day < 30; $day++) {
            $date = date('Y-m-d', strtotime("-$day days"));
            
            // 2-5 sales per day
            $salesCount = rand(2, 5);
            
            for ($i = 0; $i < $salesCount; $i++) {
                $product = $products[array_rand($products)];
                $customer = $customers[array_rand($customers)];
                
                $quantity = rand(1, 10);
                
                $sale = new Sale();
                $sale->product_id = $product->product_id;
                $sale->customer_name = $customer->customer_name;
                $sale->quantity_sold = $quantity;
                $sale->cost_price = $product->cost_price;
                $sale->selling_price = $product->selling_price;
                $sale->sale_date = $date . ' ' . sprintf('%02d:%02d:%02d', rand(8, 18), rand(0, 59), rand(0, 59));
                
                if ($sale->save()) {
                    echo "  ✓ Sale recorded: {$quantity} x {$product->product_name} on {$date}\n";
                } else {
                    echo "  ✗ Sale failed: " . json_encode($sale->errors) . "\n";
                }
            }
        }
    }
}
