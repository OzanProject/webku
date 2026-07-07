<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This migration extracts unique category_label values from the products table
     * and creates category records with generated slugs. It is idempotent and can
     * be safely re-executed.
     * 
     * Satisfies Requirements: 11.1, 11.2, 11.6
     */
    public function up(): void
    {
        // Extract unique category_label values from products
        $categoryLabels = DB::table('products')
            ->distinct()
            ->pluck('category_label')
            ->filter() // Remove nulls/empty values
            ->sort()
            ->values();

        echo "Found " . count($categoryLabels) . " unique category labels\n";

        foreach ($categoryLabels as $label) {
            // Generate slug from category label
            $slug = Str::slug($label);
            
            // Check if category already exists (idempotent check)
            $existingCategory = DB::table('categories')
                ->where('name', $label)
                ->orWhere('slug', $slug)
                ->first();

            if ($existingCategory) {
                echo "Category '{$label}' already exists (ID: {$existingCategory->id}), skipping...\n";
                continue;
            }

            // Ensure slug is unique by appending a counter if necessary
            $originalSlug = $slug;
            $counter = 1;
            while (DB::table('categories')->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            // Create the category
            $categoryId = DB::table('categories')->insertGetId([
                'name' => $label,
                'slug' => $slug,
                'description' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            echo "Created category: '{$label}' with slug '{$slug}' (ID: {$categoryId})\n";
        }

        echo "Category extraction completed successfully\n";
    }

    /**
     * Reverse the migrations.
     * 
     * Note: This does not delete categories as they may have been manually modified
     * or have relationships established. Manual cleanup should be performed if needed.
     */
    public function down(): void
    {
        // We don't automatically delete categories on rollback because:
        // 1. Categories might have been manually edited
        // 2. Products might have been assigned to these categories
        // 3. It's safer to require manual cleanup
        
        echo "Rollback note: Categories extracted by this migration are NOT automatically deleted.\n";
        echo "If you need to remove them, please do so manually or create a separate migration.\n";
    }
};
