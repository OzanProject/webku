# Implementation Plan: Laravel Production Readiness

## Overview

This implementation plan transforms the ozanproject.com Laravel 13 application into a production-ready system by addressing critical security vulnerabilities, database integrity issues, and architectural improvements. The implementation is organized into three phases following a logical dependency chain: Critical Security & Database Foundation, Architecture Refactoring, and Performance & Infrastructure.

## Tasks

### Phase 1: Critical Security & Database Foundation

- [ ] 1. Create authorization policy classes for all models
  - [x] 1.1 Create ProductPolicy with viewAny, view, create, update, delete methods
    - Implement policy methods checking `is_admin` field on User model
    - _Requirements: 1.1, 1.3, 1.4_
  
  - [x] 1.2 Create policies for Order, Category, Service, Portfolio, Testimonial, User models
    - Each policy implements viewAny, view, create, update, delete methods
    - All methods check `is_admin` field for authorization
    - _Requirements: 1.1, 1.3, 1.4_
  
  - [-] 1.3 Register policies in AuthServiceProvider
    - Map each model to its corresponding policy class
    - Enable automatic policy discovery if not using explicit registration
    - _Requirements: 1.1_
  
  - [ ]* 1.4 Write property test for authorization verification (Property 1)
    - **Property 1: Authorization Verification for Admin Actions**
    - **Validates: Requirements 1.2**
    - Test that admin users pass all policy checks (viewAny, view, create, update, delete)
    - Test that non-admin users fail all policy checks
    - Run across all 7 resource types (Product, Order, Category, Service, Portfolio, Testimonial, User)

- [ ] 2. Integrate authorization into controllers
  - [-] 2.1 Add authorize() calls to ProductController for all CRUD methods
    - Add `authorize('viewAny', Product::class)` to index method
    - Add `authorize('view', $product)` to show method
    - Add `authorize('create', Product::class)` to create method
    - Add `authorize('update', $product)` to edit/update methods
    - Add `authorize('delete', $product)` to destroy method
    - _Requirements: 1.2, 1.6_
  
  - [~] 2.2 Add authorize() calls to all other admin resource controllers
    - Apply same pattern to CategoryController, OrderController, ServiceController
    - Apply to PortfolioController, TestimonialController, UserController
    - Ensure all administrative actions are protected
    - _Requirements: 1.2, 1.6_
  
  - [ ]* 2.3 Write feature tests for authorization enforcement
    - Test that unauthorized users receive 403 Forbidden responses
    - Test that authorized admin users can perform actions
    - Cover all controllers and all CRUD operations
    - _Requirements: 1.5, 5.1_

- [ ] 3. Database schema: Create categories table and migrate data
  - [x] 3.1 Create migration for categories table
    - Add id, name, slug (unique), description, is_active, timestamps columns
    - Add index on slug and is_active columns
    - _Requirements: 2.1, 4.1_
  
  - [x] 3.2 Create data migration to extract categories from products
    - Extract unique category_label values from products table
    - Create category records with generated slugs
    - Make migration idempotent for safe re-execution
    - _Requirements: 11.1, 11.2, 11.6_
  
  - [ ] 3.3 Add category_id foreign key to products table
    - Add nullable category_id column
    - Create foreign key constraint to categories.id with onDelete SET NULL
    - Populate category_id by matching category_label to category names
    - Drop category_label column after migration
    - _Requirements: 2.2, 2.6, 2.7, 11.3, 11.7_
  
  - [ ]* 3.4 Write migration tests
    - Test categories are correctly extracted and created
    - Test products.category_id correctly populated from category_label
    - Test foreign key constraints are enforced
    - _Requirements: 5.2, 11.6_

- [ ] 4. Add foreign key relationships to orders table
  - [~] 4.1 Create migration adding foreign keys to orders
    - Add nullable user_id foreign key referencing users.id with onDelete SET NULL
    - Add nullable product_id foreign key referencing products.id with onDelete SET NULL
    - Add nullable service_id foreign key referencing services.id with onDelete SET NULL
    - Create indexes on user_id, product_id, service_id columns
    - _Requirements: 2.3, 2.4, 2.5, 2.6, 2.7, 4.8_
  
  - [~] 4.2 Migrate existing order data to populate foreign keys
    - Populate product_id for orders with order_type='Produk' by matching item_name to product titles
    - Populate service_id for orders with order_type='Layanan' by matching item_name to service titles
    - _Requirements: 11.4, 11.5_
  
  - [ ]* 4.3 Write tests for order foreign key relationships
    - Test foreign key constraints enforce referential integrity
    - Test cascade actions work correctly (SET NULL on delete)
    - _Requirements: 5.2_

- [ ] 5. Add database performance indexes
  - [~] 5.1 Create migration for product table indexes
    - Add index on products.slug column
    - Add index on products.is_active column
    - Add composite index on (category_id, is_active, sort_order) for catalog queries
    - _Requirements: 4.1, 4.2, 4.3, 4.4_
  
  - [~] 5.2 Create migration for order table indexes
    - Add index on orders.status column
    - Add index on orders.customer_email column
    - Verify unique index exists on orders.order_number (should already exist)
    - _Requirements: 4.5, 4.6, 4.7_
  
  - [ ]* 5.3 Write performance tests for indexed queries
    - Verify catalog queries use the composite index (EXPLAIN output)
    - Verify order lookup queries use appropriate indexes
    - _Requirements: 5.8_

- [ ] 6. Update Eloquent models with relationship definitions
  - [~] 6.1 Add relationships to Product model
    - Add belongsTo relationship to Category (category())
    - Add hasMany relationship to Order (orders())
    - Add fillable fields including category_id
    - _Requirements: 3.1, 3.2_
  
  - [~] 6.2 Add relationships to Order model
    - Add belongsTo to User (user()), Product (product()), Service (service())
    - Add fillable fields including user_id, product_id, service_id
    - _Requirements: 3.3, 3.4, 3.5_
  
  - [~] 6.3 Add relationships to Category, Service, User models
    - Category: hasMany to Product (products())
    - Service: hasMany to Order (orders())
    - User: hasMany to Order (orders())
    - _Requirements: 3.6, 3.7, 3.8_
  
  - [ ]* 6.4 Write relationship tests
    - Test all relationships return correct related models
    - Test eager loading prevents N+1 query problems
    - _Requirements: 5.2_

- [~] 7. Checkpoint - Phase 1 validation
  - Ensure all tests pass
  - Verify authorization works on all admin controllers
  - Verify database migrations complete successfully
  - Verify relationships load correctly
  - Ask the user if questions arise

### Phase 2: Architecture Refactoring

- [ ] 8. Create repository classes for data access abstraction
  - [~] 8.1 Create ProductRepository with core query methods
    - Implement all(), find(), findBySlug(), active(), byCategory()
    - Implement activeByCategory(), paginatedWithFilters() for admin listing
    - Implement create(), update(), delete() methods
    - _Requirements: 10.1, 10.3, 10.5, 10.6_
  
  - [~] 8.2 Create OrderRepository with core query methods
    - Implement all(), find(), findByOrderNumber(), pending(), byCustomerEmail()
    - Implement paginated(), paginatedWithFilters() for admin listing
    - Implement create(), update(), delete() methods
    - Use query scopes from Order model (pending scope)
    - _Requirements: 10.2, 10.4, 10.5, 10.6, 10.7_
  
  - [ ]* 8.3 Write repository unit tests
    - Test all query methods return correct data structures
    - Test filtering and pagination logic
    - Test scopes are applied correctly
    - _Requirements: 5.5_

- [ ] 9. Create infrastructure service classes
  - [~] 9.1 Create FileUploadService for file operations
    - Implement uploadProductImage() with validation (format, size)
    - Implement delete() for removing files from storage
    - Validate image format (jpg, jpeg, png, webp) and max size 2MB
    - _Requirements: 6.3_
  
  - [~] 9.2 Create SlugGenerationService for unique slug generation
    - Implement generate() method accepting title, model class, optional exclude ID
    - Generate URL-safe slugs (lowercase alphanumeric + hyphens)
    - Ensure uniqueness by appending counter when slug exists
    - _Requirements: 6.4_
  
  - [~] 9.3 Create CacheService for cache management
    - Implement remember() wrapper for cache operations
    - Implement invalidateProducts(), invalidateCategories(), invalidateSettings()
    - Support pattern-based invalidation for product cache keys
    - _Requirements: 6.7, 8.4, 8.5, 8.6_
  
  - [ ]* 9.4 Write property test for slug generation (Property 3)
    - **Property 3: Slug Generation Correctness**
    - **Validates: Requirements 5.4**
    - Test slugs contain only lowercase alphanumeric and hyphens
    - Test slugs don't start/end with hyphens
    - Test slugs don't contain consecutive hyphens
    - Test slug uniqueness across 100 random input strings
  
  - [ ]* 9.5 Write unit tests for infrastructure services
    - Test FileUploadService validation and upload logic
    - Test SlugGenerationService uniqueness handling
    - Test CacheService invalidation methods
    - _Requirements: 5.5_

- [ ] 10. Create business logic service classes
  - [~] 10.1 Create ProductService with business operations
    - Implement create() using SlugGenerationService, FileUploadService, CacheService
    - Implement update() with slug regeneration and image replacement logic
    - Implement delete() with file cleanup
    - Implement getAdminListing() for paginated admin view
    - Implement getProductsByCategory() with caching for frontend
    - Wrap operations in database transactions
    - _Requirements: 6.1, 6.5, 6.6, 15.2_
  
  - [~] 10.2 Create OrderService with order management logic
    - Implement create() with order number generation and price calculation
    - Implement updateStatus() for order workflow
    - Implement calculatePrice() based on product/service
    - Implement generateOrderNumber() with ORD-YYYYMMDD-XXXX format
    - Wrap operations in database transactions
    - _Requirements: 6.2, 6.5, 6.6, 15.1_
  
  - [ ]* 10.3 Write property test for order number uniqueness (Property 2)
    - **Property 2: Order Number Uniqueness**
    - **Validates: Requirements 5.3**
    - Generate 100 orders and verify all order numbers are unique
    - Test concurrent order creation doesn't produce duplicates
  
  - [ ]* 10.4 Write unit tests for service layer business logic
    - Test ProductService create, update, delete operations
    - Test OrderService price calculation logic
    - Test order number generation format
    - _Requirements: 5.5_

- [ ] 11. Create Form Request validation classes
  - [~] 11.1 Create form requests for Product operations
    - Create StoreProductRequest with validation rules and authorize() method
    - Create UpdateProductRequest with validation rules and authorize() method
    - Create ImportProductsRequest for Excel file validation
    - Add custom Indonesian validation messages
    - _Requirements: 7.1, 7.2, 7.4, 7.6, 7.7_
  
  - [~] 11.2 Create StoreOrderRequest for order creation
    - Implement validation rules for customer info and order type
    - Use conditional validation: require product_id if order_type is 'Produk'
    - Use conditional validation: require service_id if order_type is 'Layanan'
    - Set authorize() to return true (frontend users can create orders)
    - _Requirements: 7.3, 7.6, 7.7_
  
  - [~] 11.3 Create form requests for other admin resources
    - Create form request classes for Category, Service, Portfolio, Testimonial, User
    - Each includes validation rules and authorization logic
    - _Requirements: 7.5, 7.6, 7.7_
  
  - [ ]* 11.4 Write feature tests for form request validation
    - Test validation rules reject invalid input
    - Test authorization failures return 403
    - Test valid input passes validation
    - _Requirements: 5.2_

- [ ] 12. Refactor controllers to use services and form requests
  - [~] 12.1 Refactor ProductController to use ProductService
    - Inject ProductService via constructor
    - Replace controller business logic with service method calls
    - Use StoreProductRequest and UpdateProductRequest for validation
    - Controller methods should be under 20 lines each
    - _Requirements: 6.5, 6.7_
  
  - [~] 12.2 Refactor OrderController to use OrderService
    - Inject OrderService via constructor
    - Replace controller business logic with service method calls
    - Use StoreOrderRequest for validation
    - _Requirements: 6.5, 6.7_
  
  - [~] 12.3 Refactor remaining admin controllers
    - Apply same pattern to Category, Service, Portfolio, Testimonial, User controllers
    - Ensure all controllers under 100 lines total
    - _Requirements: 6.5, 6.7_
  
  - [ ]* 12.4 Write feature tests for refactored controllers
    - Test all CRUD operations work correctly through controllers
    - Test controllers return appropriate HTTP responses
    - Test validation and authorization integration
    - _Requirements: 5.2_

- [~] 13. Checkpoint - Phase 2 validation
  - Ensure all tests pass
  - Verify service layer handles business logic correctly
  - Verify controllers are thin and delegate to services
  - Verify form request validation works
  - Ask the user if questions arise

### Phase 3: Performance & Infrastructure

- [ ] 14. Implement caching layer with invalidation
  - [~] 14.1 Add settings caching to AppServiceProvider
    - Cache all settings with key "app.settings" and 24-hour TTL
    - Share cached settings with all views
    - _Requirements: 8.1_
  
  - [~] 14.2 Implement category caching
    - Cache active categories with key "categories.active" and 1-hour TTL
    - Use CacheService for caching operations
    - _Requirements: 8.2_
  
  - [~] 14.3 Implement product catalog caching
    - Cache paginated product queries with keys including pagination params
    - Implement in ProductService.getProductsByCategory()
    - _Requirements: 8.3_
  
  - [~] 14.4 Create model observers for cache invalidation
    - Create ProductObserver to invalidate product caches on create/update/delete
    - Create CategoryObserver to invalidate category caches on mutations
    - Create SettingObserver to invalidate settings cache on mutations
    - Register observers in EventServiceProvider
    - _Requirements: 8.4, 8.5, 8.6_
  
  - [ ]* 14.5 Write property test for cache invalidation (Property 4)
    - **Property 4: Cache Invalidation on Model Mutations**
    - **Validates: Requirements 8.4, 8.5, 8.6**
    - Test cache is invalidated after creating Product, Category, Setting
    - Test cache is invalidated after updating these models
    - Test cache is invalidated after deleting these models

- [ ] 15. Implement queue system for long-running tasks
  - [~] 15.1 Create ImportProductsJob for async Excel imports
    - Implement handle() method processing Excel file in chunks of 100
    - Use ProductService to create products
    - Configure retry attempts: 3 times with exponential backoff
    - Wrap each row in database transaction for row-level rollback
    - Log errors for failed rows with row number and data
    - _Requirements: 9.1, 9.4, 9.6, 9.7, 15.3_
  
  - [ ] 15.2 Update ProductController to dispatch ImportProductsJob
    - In importExcel() method, store uploaded file
    - Dispatch ImportProductsJob with file path and user ID
    - Return immediate response to user indicating processing started
    - _Requirements: 9.2_
  
  - [~] 15.3 Configure queue system for production
    - Set QUEUE_CONNECTION to 'database' in production environment
    - Create database tables for queue jobs (jobs, failed_jobs)
    - Configure queue worker settings in queue.php config
    - _Requirements: 9.3_
  
  - [ ]* 15.4 Write feature tests for Excel import functionality
    - Test successful import creates products correctly
    - Test validation errors are logged properly
    - Test job retries on failure
    - _Requirements: 5.6, 9.5_

- [ ] 16. Configure production environment settings
  - [~] 16.1 Create production environment validation command
    - Validate APP_ENV is "production"
    - Validate APP_DEBUG is false
    - Validate APP_KEY is set and strong
    - Validate database is not SQLite
    - Validate cache driver is Redis or Memcached
    - Validate queue driver is Redis or database
    - Validate session driver is Redis or database
    - _Requirements: 12.1, 12.2, 12.3, 12.4, 12.5, 12.6, 12.7, 12.9_
  
  - [~] 16.2 Update config files for production optimization
    - Configure cache.php for Redis
    - Configure queue.php for Redis/database
    - Configure session.php for Redis/database
    - Set appropriate timeouts and retry policies
    - _Requirements: 12.5, 12.6, 12.7_
  
  - [~] 16.3 Add OPcache configuration check
    - Document OPcache PHP settings required for production
    - Add validation that OPcache is enabled in production
    - _Requirements: 12.8_

- [ ] 17. Implement error handling and logging
  - [~] 17.1 Create custom exception handlers in Handler.php
    - Handle AuthorizationException with user context logging
    - Handle ModelNotFoundException with model details logging
    - Handle QueryException with SQL and bindings logging
    - Handle FileException with file metadata logging
    - Return appropriate HTTP responses for each exception type
    - _Requirements: 13.1, 13.2, 13.3, 13.7_
  
  - [~] 17.2 Configure logging channels
    - Set up daily log rotation with 14-day retention
    - Configure separate authorization log channel with 30-day retention
    - Configure queue log channel with 7-day retention
    - Configure Slack notification channel for errors (optional)
    - _Requirements: 13.1, 13.2, 13.3, 13.4, 13.5, 13.6_
  
  - [~] 17.3 Add comprehensive logging throughout application
    - Add logging to ImportProductsJob for row errors
    - Add logging to FileUploadService for upload failures
    - Add logging to authorization policy failures
    - Add logging to OrderService for order creation
    - _Requirements: 13.1, 13.4, 13.5_

- [ ] 18. Implement API rate limiting
  - [~] 18.1 Configure rate limiting middleware
    - Set 10 requests/minute per IP for frontend order submission endpoints
    - Set 5 requests/minute per IP for authentication endpoints
    - Set 60 requests/minute per user for admin endpoints
    - _Requirements: 14.1, 14.2, 14.3_
  
  - [~] 18.2 Add rate limit response handling
    - Return 429 Too Many Requests when limit exceeded
    - Include Retry-After header in rate limit responses
    - Log rate limit violations with IP, endpoint, timestamp
    - _Requirements: 14.4, 14.5, 14.6_
  
  - [ ]* 18.3 Write tests for rate limiting
    - Test rate limits enforce correctly on each endpoint type
    - Test Retry-After header is included
    - Test legitimate requests within limits pass through

- [ ] 19. Ensure database transaction management
  - [~] 19.1 Add transaction wrapping in service layer
    - Verify ProductService methods use DB::transaction()
    - Verify OrderService methods use DB::transaction()
    - Verify ImportProductsJob processes rows in transactions
    - _Requirements: 15.1, 15.2, 15.3_
  
  - [~] 19.2 Configure transaction isolation level
    - Set transaction isolation level to READ COMMITTED
    - Document transaction boundaries in service methods
    - _Requirements: 15.4, 15.5, 15.6_
  
  - [ ]* 19.3 Write tests for transaction rollback behavior
    - Test failed operations rollback correctly
    - Test partial failures in Excel import rollback per row
    - Test multi-step operations are atomic

- [ ] 20. Register service dependencies in service provider
  - [~] 20.1 Register repositories and services in AppServiceProvider
    - Register repositories as singletons (ProductRepository, OrderRepository)
    - Register infrastructure services (FileUploadService, SlugGenerationService, CacheService)
    - Register business services (ProductService, OrderService)
    - Configure dependency injection for constructor parameters
    - _Requirements: 6.1, 6.2, 6.3, 6.4, 10.1, 10.2_

- [ ] 21. Final validation and documentation
  - [~] 21.1 Run comprehensive test suite
    - Execute all unit tests
    - Execute all feature tests
    - Execute all property-based tests
    - Verify minimum 80% code coverage achieved
    - Verify test suite completes in under 60 seconds
    - _Requirements: 5.7, 5.8_
  
  - [~] 21.2 Create deployment documentation
    - Document database migration steps
    - Document production environment setup
    - Document queue worker configuration
    - Document Redis/cache setup
    - Document backup and rollback procedures
  
  - [~] 21.3 Create production readiness checklist
    - Verify all security requirements met
    - Verify all performance optimizations implemented
    - Verify error handling and logging configured
    - Verify rate limiting active
    - Verify monitoring and health checks ready

- [~] 22. Final checkpoint - Production readiness validation
  - Run all tests and verify 100% pass rate
  - Run production environment validation command
  - Verify all 15 requirements fully implemented
  - Review with user for sign-off on production deployment
  - Ask the user if questions arise

## Notes

- Tasks marked with `*` are optional test sub-tasks that can be skipped for faster MVP (though highly recommended for production quality)
- Each task references specific requirements from the requirements document for traceability
- Property-based tests validate universal correctness properties defined in the design document
- The implementation follows a 3-phase structure: Phase 1 (Critical Security & Database Foundation), Phase 2 (Architecture Refactoring), Phase 3 (Performance & Infrastructure)
- Checkpoints ensure incremental validation at the end of each phase
- All database operations are wrapped in transactions to maintain data consistency
- Service layer and repository pattern provide clean separation of concerns for improved testability
- Authorization is enforced at both the form request level and controller level for defense in depth
- Caching strategy improves performance while cache invalidation maintains data consistency
- Queue system prevents timeout issues on long-running Excel imports
- The dependency graph organizes tasks into parallel execution waves to maximize efficiency

## Task Dependency Graph

```json
{
  "waves": [
    { "id": 0, "tasks": ["1.1", "3.1"] },
    { "id": 1, "tasks": ["1.2", "3.2"] },
    { "id": 2, "tasks": ["1.3", "1.4", "2.1", "3.3"] },
    { "id": 3, "tasks": ["2.2", "3.4", "4.1"] },
    { "id": 4, "tasks": ["2.3", "4.2"] },
    { "id": 5, "tasks": ["4.3", "5.1", "5.2", "6.1"] },
    { "id": 6, "tasks": ["5.3", "6.2", "6.3"] },
    { "id": 7, "tasks": ["6.4", "8.1", "8.2"] },
    { "id": 8, "tasks": ["8.3", "9.1", "9.2", "9.3"] },
    { "id": 9, "tasks": ["9.4", "9.5", "10.1", "10.2"] },
    { "id": 10, "tasks": ["10.3", "10.4", "11.1", "11.2"] },
    { "id": 11, "tasks": ["11.3", "11.4", "12.1", "12.2"] },
    { "id": 12, "tasks": ["12.3", "12.4", "14.1", "14.2"] },
    { "id": 13, "tasks": ["14.3", "14.4"] },
    { "id": 14, "tasks": ["14.5", "15.1"] },
    { "id": 15, "tasks": ["15.2", "15.3"] },
    { "id": 16, "tasks": ["15.4", "16.1", "16.2"] },
    { "id": 17, "tasks": ["16.3", "17.1", "17.2"] },
    { "id": 18, "tasks": ["17.3", "18.1"] },
    { "id": 19, "tasks": ["18.2", "18.3", "19.1"] },
    { "id": 20, "tasks": ["19.2", "19.3", "20.1"] },
    { "id": 21, "tasks": ["21.1", "21.2", "21.3"] }
  ]
}
```
