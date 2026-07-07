<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductControllerAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_cannot_access_product_index(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)->get(route('admin.products.index'));

        $response->assertStatus(403);
    }

    public function test_admin_can_access_product_index(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get(route('admin.products.index'));

        $response->assertStatus(200);
    }

    public function test_non_admin_cannot_access_product_create_form(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)->get(route('admin.products.create'));

        $response->assertStatus(403);
    }

    public function test_admin_can_access_product_create_form(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get(route('admin.products.create'));

        $response->assertStatus(200);
    }

    public function test_non_admin_cannot_store_product(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)->post(route('admin.products.store'), [
            'title' => 'Test Product',
            'category_label' => 'Test Category',
            'description' => 'Test Description',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response->assertStatus(403);
    }

    public function test_admin_can_store_product(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post(route('admin.products.store'), [
            'title' => 'Test Product',
            'category_label' => 'Test Category',
            'description' => 'Test Description',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseHas('products', [
            'title' => 'Test Product',
            'category_label' => 'Test Category',
        ]);
    }

    public function test_non_admin_cannot_access_product_edit_form(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.products.edit', $product->id));

        $response->assertStatus(403);
    }

    public function test_admin_can_access_product_edit_form(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $product = Product::factory()->create();

        $response = $this->actingAs($admin)->get(route('admin.products.edit', $product->id));

        $response->assertStatus(200);
    }

    public function test_non_admin_cannot_update_product(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->put(route('admin.products.update', $product->id), [
            'title' => 'Updated Product',
            'category_label' => 'Updated Category',
            'description' => 'Updated Description',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response->assertStatus(403);
    }

    public function test_admin_can_update_product(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $product = Product::factory()->create(['title' => 'Original Title']);

        $response = $this->actingAs($admin)->put(route('admin.products.update', $product->id), [
            'title' => 'Updated Product',
            'category_label' => 'Updated Category',
            'description' => 'Updated Description',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'title' => 'Updated Product',
        ]);
    }

    public function test_non_admin_cannot_delete_product(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->delete(route('admin.products.destroy', $product->id));

        $response->assertStatus(403);
        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }

    public function test_admin_can_delete_product(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['is_admin' => true]);
        $product = Product::factory()->create();

        $response = $this->actingAs($admin)->delete(route('admin.products.destroy', $product->id));

        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_non_admin_cannot_download_import_template(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)->get(route('admin.products.download-template'));

        $response->assertStatus(403);
    }

    public function test_admin_can_download_import_template(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get(route('admin.products.download-template'));

        $response->assertStatus(200);
        $response->assertDownload('template_import_produk.xlsx');
    }

    public function test_non_admin_cannot_import_excel(): void
    {
        Storage::fake('public');
        $user = User::factory()->create(['is_admin' => false]);
        $file = UploadedFile::fake()->create('products.xlsx', 100);

        $response = $this->actingAs($user)->post(route('admin.products.import'), [
            'file' => $file,
        ]);

        $response->assertStatus(403);
    }

    public function test_admin_can_import_excel(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['is_admin' => true]);
        
        // Create a temporary Excel file with product data
        $tempPath = storage_path('app/test_products.xlsx');
        $writer = \Spatie\SimpleExcel\SimpleExcelWriter::create($tempPath);
        $writer->addRow([
            'title' => 'Imported Product',
            'category_label' => 'Imported Category',
            'price' => '100000',
            'description' => 'Imported Description',
            'is_active' => '1',
            'sort_order' => '1'
        ]);
        $writer->close();

        $file = new UploadedFile($tempPath, 'products.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', null, true);

        $response = $this->actingAs($admin)->post(route('admin.products.import'), [
            'file' => $file,
        ]);

        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseHas('products', [
            'title' => 'Imported Product',
            'category_label' => 'Imported Category',
        ]);

        // Clean up
        if (file_exists($tempPath)) {
            unlink($tempPath);
        }
    }

    public function test_guest_cannot_access_any_product_routes(): void
    {
        $product = Product::factory()->create();

        $this->get(route('admin.products.index'))->assertRedirect(route('login'));
        $this->get(route('admin.products.create'))->assertRedirect(route('login'));
        $this->post(route('admin.products.store'))->assertRedirect(route('login'));
        $this->get(route('admin.products.edit', $product->id))->assertRedirect(route('login'));
        $this->put(route('admin.products.update', $product->id))->assertRedirect(route('login'));
        $this->delete(route('admin.products.destroy', $product->id))->assertRedirect(route('login'));
    }
}

