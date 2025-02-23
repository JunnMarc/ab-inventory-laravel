<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        // Trigger for Categories: Before Insert
        DB::unprepared("
            CREATE TRIGGER before_insert_categories
            BEFORE INSERT ON Categories
            FOR EACH ROW
            BEGIN
                DECLARE next_id INT;

                -- Find the next available category_id
                SELECT COALESCE(MIN(c.category_id + 1), 1) INTO next_id
                FROM Categories c
                WHERE NOT EXISTS (
                    SELECT 1 FROM Categories WHERE category_id = c.category_id + 1
                );

                -- Assign the next available category_id
                SET NEW.category_id = next_id;
            END;
        ");

        // Trigger for Products: Before Insert
        DB::unprepared("
            CREATE TRIGGER before_insert_products
            BEFORE INSERT ON Products
            FOR EACH ROW
            BEGIN
                DECLARE next_id INT;

                -- Find the next available product_id
                SELECT COALESCE(MIN(t1.product_id + 1), 1) INTO next_id
                FROM Products t1
                WHERE NOT EXISTS (
                    SELECT 1 FROM Products t2 WHERE t2.product_id = t1.product_id + 1
                );

                -- Assign the next available product_id
                SET NEW.product_id = next_id;
            END;
        ");
    }

    public function down(): void {
        // Drop the triggers if the migration is rolled back
        DB::unprepared("DROP TRIGGER IF EXISTS before_insert_categories;");
        DB::unprepared("DROP TRIGGER IF EXISTS before_insert_products;");
    }
};

