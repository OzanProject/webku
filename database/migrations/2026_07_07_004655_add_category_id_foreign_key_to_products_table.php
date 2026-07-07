<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This migration adds category_id foreign key to products table, populates it
     * by matching category_label values, and drops the category_label column.
     * 
     * Satisfies Requirements: 2.2, 2.6, 2.7, 11.3, 11.7
     */
    public function up(): void
    {
        // Step 1: Add nullable category_id column
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('category_label');
        });

        echo "Added category_id column to products table\n";

        // Step 2: Populate category_id by matching category_label to category names
        $products = DB::table('products')->whereNotNull('category_label')->get();
        
        echo "Found " . count($products) . " products to migrate\n";
        
        $migrated = 0;
        $notFound = 0;
        
        foreach ($products as $product) {
            // Find matching category by name
            $category = DB::table('categories')
                ->where('name', $product->category_label)
                ->first();

            if ($category) {
                DB::table('products')
                    ->where('id', $product->id)
                    ->update(['category_id' => $category->id]);
                $migrated++;
            } else {
                echo "Warning: No category found for product '{$product->title}' with category_label '{$product->category_label}'\n";
                $notFound++;
            }
        }

        echo "Successfully migrated {$migrated} products\n";
        if ($notFound > 0) {
            echo "Warning: {$notFound} products could not be matched to categories\n";
        }

        // Step 3: Add foreign key constraint with onDelete SET NULL
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });

        echo "Added foreign key constraint on category_id\n";

        // Step 4: Drop category_label column
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category_label');
        });

        echo "Dropped category_label column\n";
        echo "Migration completed successfully\n";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Step 1: Re-add category_label column
        Schema::table('products', function (Blueprint $table) {
            $table->string('category_label')->nullable()->after('title');
        });

        // Step 2: Restore category_label values from category_id
        $products = DB::table('products')
            ->whereNotNull('category_id')
            ->get();

        foreach ($products as $product) {
            $category = DB::table('categories')
                ->where('id', $product->category_id)
                ->first();

            if ($category) {
                DB::table('products')
                    ->where('id', $product->id)
                    ->update(['category_label' => $category->name]);
            }
        }

        // Step 3: Drop foreign key constraint and category_id column
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });

        echo "Rollback completed successfully\n";
    }
};
