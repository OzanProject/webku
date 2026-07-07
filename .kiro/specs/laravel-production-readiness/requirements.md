# Requirements Document

## Introduction

This document specifies the requirements for making the ozanproject.com Laravel 13 application production-ready. The application currently has critical security vulnerabilities, database design flaws, and architectural issues that prevent safe deployment to production. This specification addresses these issues through two phases: Phase 1 focuses on critical security and database foundation improvements, while Phase 2 addresses important architectural refactoring and performance optimizations.

The application is a digital agency website offering products (templates, scripts), services (web development, applications), and order management. It currently uses Laravel Breeze for authentication, SQLite database, and serves both frontend and admin interfaces.

## Glossary

- **Application**: The ozanproject.com Laravel 13 web application
- **Admin_User**: An authenticated user with administrative privileges
- **Frontend_User**: A visitor or customer accessing the public website
- **Authorization_System**: Laravel's policy-based authorization framework using gates and policies
- **Database_Schema**: The structure of database tables including columns, foreign keys, and indexes
- **Eloquent_Relationship**: Laravel's ORM relationship definitions (hasMany, belongsTo, etc.)
- **Form_Request**: Laravel's request validation classes that encapsulate validation logic
- **Service_Layer**: Business logic classes that handle complex operations outside controllers
- **Queue_System**: Laravel's job queue for handling asynchronous tasks
- **Cache_Layer**: Laravel's caching system for storing frequently accessed data
- **Property_Test**: A property-based test that verifies behavior across many generated inputs
- **Migration**: Laravel database schema modification file
- **Policy**: Laravel authorization class that defines permissions for a model
- **Repository**: Data access layer class that abstracts database queries
- **Job**: Laravel queue job class for asynchronous processing
- **Resource_Controller**: Controller managing CRUD operations for a specific model
- **Excel_Import**: The process of bulk importing data from Excel/CSV files
- **Order_Management_System**: The subsystem handling customer orders from creation to completion
- **Product_Catalog**: The subsystem managing products with categories and pricing

## Requirements

### Phase 1: Critical Security & Database Foundation

---

### Requirement 1: Authorization System Implementation

**User Story:** As an Admin_User, I want all administrative actions to be properly authorized, so that unauthorized users cannot access or modify administrative resources.

#### Acceptance Criteria

1. THE Application SHALL implement Laravel policies for Product, Order, Category, Service, Portfolio, Testimonial, and User models
2. WHEN an Admin_User attempts any administrative action, THE Authorization_System SHALL verify the user has the required permission
3. THE Application SHALL implement a viewAny policy method for index/list operations on all Resource_Controllers
4. THE Application SHALL implement view, create, update, and delete policy methods for all Resource_Controllers
5. WHEN an unauthorized user attempts an administrative action, THE Authorization_System SHALL return a 403 Forbidden response
6. THE Application SHALL apply authorization checks using the authorize() method in all Resource_Controllers before executing actions

---

### Requirement 2: Database Foreign Key Relationships

**User Story:** As a developer, I want proper foreign key relationships between tables, so that data integrity is enforced at the database level.

#### Acceptance Criteria

1. THE Database_Schema SHALL define a categories table with an id primary key
2. THE Database_Schema SHALL replace the category_label string column in products table with a category_id foreign key referencing categories.id
3. THE Database_Schema SHALL add a product_id foreign key column to orders table referencing products.id for product orders
4. THE Database_Schema SHALL add a service_id foreign key column to orders table referencing services.id for service orders
5. THE Database_Schema SHALL add a user_id foreign key column to orders table referencing users.id
6. WHEN a referenced record is deleted, THE Database_Schema SHALL enforce the appropriate cascade action (CASCADE or SET NULL based on business rules)
7. THE Database_Schema SHALL create foreign key constraints with onDelete and onUpdate actions specified

---

### Requirement 3: Eloquent Model Relationships

**User Story:** As a developer, I want Eloquent relationships defined in models, so that I can efficiently query related data without manual joins.

#### Acceptance Criteria

1. THE Product model SHALL define a belongsTo relationship method to Category named category()
2. THE Product model SHALL define a hasMany relationship method to Order named orders()
3. THE Order model SHALL define a belongsTo relationship method to Product named product()
4. THE Order model SHALL define a belongsTo relationship method to Service named service()
5. THE Order model SHALL define a belongsTo relationship method to User named user()
6. THE Category model SHALL define a hasMany relationship method to Product named products()
7. THE Service model SHALL define a hasMany relationship method to Order named orders()
8. THE User model SHALL define a hasMany relationship method to Order named orders()

---

### Requirement 4: Database Performance Indexes

**User Story:** As a developer, I want proper database indexes on frequently queried columns, so that database queries execute efficiently under production load.

#### Acceptance Criteria

1. THE Database_Schema SHALL create an index on products.slug column
2. THE Database_Schema SHALL create an index on products.is_active column
3. THE Database_Schema SHALL create an index on products.category_id column
4. THE Database_Schema SHALL create a composite index on products (category_id, is_active, sort_order) for the catalog listing query
5. THE Database_Schema SHALL create an index on orders.status column
6. THE Database_Schema SHALL create an index on orders.order_number column (already unique)
7. THE Database_Schema SHALL create an index on orders.customer_email column for customer lookup queries
8. THE Database_Schema SHALL create indexes on all foreign key columns not already indexed

---

### Requirement 5: Comprehensive Test Coverage

**User Story:** As a developer, I want comprehensive test coverage for critical application features, so that I can detect regressions and deploy confidently.

#### Acceptance Criteria

1. THE Application SHALL implement feature tests for all authorization policies covering allowed and denied scenarios
2. THE Application SHALL implement feature tests for all CRUD operations in Resource_Controllers
3. THE Application SHALL implement property tests for the Order_Management_System order number generation verifying uniqueness across 100 generated orders
4. THE Application SHALL implement property tests for slug generation in Product and Category models verifying URL-safe format across various input strings
5. THE Application SHALL implement unit tests for all Service_Layer business logic methods
6. THE Application SHALL implement feature tests for the Excel_Import functionality verifying successful import and error handling
7. THE Application SHALL achieve minimum 80% code coverage for all models, controllers, and service classes
8. WHEN tests are executed, THE Application SHALL complete the test suite in under 60 seconds

---

### Phase 2: Architecture & Performance

---

### Requirement 6: Service Layer Extraction

**User Story:** As a developer, I want business logic extracted from controllers into service classes, so that code is testable, reusable, and follows single responsibility principle.

#### Acceptance Criteria

1. THE Application SHALL implement a ProductService class handling product creation, update, deletion, and Excel import logic
2. THE Application SHALL implement an OrderService class handling order creation, status updates, and price calculation logic
3. THE Application SHALL implement a FileUploadService class handling all file upload, validation, and storage operations
4. THE Application SHALL implement a SlugGenerationService class handling unique slug generation for all models requiring slugs
5. WHEN a controller receives a request, THE controller SHALL delegate business logic to the appropriate Service_Layer class
6. THE Service_Layer classes SHALL return data transfer objects or arrays, not direct HTTP responses
7. THE controllers SHALL remain under 100 lines of code after Service_Layer extraction

---

### Requirement 7: Form Request Validation

**User Story:** As a developer, I want validation logic encapsulated in Form Request classes, so that validation rules are reusable and controllers remain clean.

#### Acceptance Criteria

1. THE Application SHALL implement a StoreProductRequest Form_Request class containing product creation validation rules
2. THE Application SHALL implement an UpdateProductRequest Form_Request class containing product update validation rules
3. THE Application SHALL implement a StoreOrderRequest Form_Request class containing order creation validation rules
4. THE Application SHALL implement an ImportProductsRequest Form_Request class containing Excel import file validation rules
5. THE Application SHALL implement Form_Request classes for all other Resource_Controllers (Category, Service, Portfolio, Testimonial, User)
6. WHEN a Form_Request authorization fails, THE Application SHALL return a 403 response
7. WHEN a Form_Request validation fails, THE Application SHALL return validation errors to the user

---

### Requirement 8: Cache Layer Implementation

**User Story:** As a developer, I want frequently accessed data cached, so that database queries are minimized and response times are improved.

#### Acceptance Criteria

1. THE Application SHALL cache all settings data loaded in AppServiceProvider with a cache key "app.settings"
2. THE Application SHALL cache active categories with a cache key "categories.active" with 1 hour TTL
3. THE Application SHALL cache the product catalog query results with cache keys including pagination parameters
4. WHEN a Setting model is created, updated, or deleted, THE Cache_Layer SHALL invalidate the "app.settings" cache key
5. WHEN a Category model is created, updated, or deleted, THE Cache_Layer SHALL invalidate the "categories.active" cache key
6. WHEN a Product model is created, updated, or deleted, THE Cache_Layer SHALL invalidate all "products.*" cache keys
7. THE Application SHALL implement a CacheService class managing cache keys and invalidation logic

---

### Requirement 9: Queue System for Long-Running Tasks

**User Story:** As an Admin_User, I want long-running tasks processed asynchronously, so that the admin interface remains responsive during operations like Excel imports.

#### Acceptance Criteria

1. THE Application SHALL implement an ImportProductsJob Job class that processes Excel file imports asynchronously
2. WHEN an Admin_User uploads an Excel file for import, THE Application SHALL dispatch ImportProductsJob to the Queue_System
3. THE Application SHALL configure the Queue_System to use the database queue driver in production
4. THE ImportProductsJob SHALL process Excel rows in chunks of 100 records to manage memory usage
5. WHEN the ImportProductsJob completes successfully, THE Queue_System SHALL mark the job as completed
6. WHEN the ImportProductsJob fails, THE Queue_System SHALL retry the job up to 3 times with exponential backoff
7. IF the ImportProductsJob fails after all retries, THEN THE Application SHALL log the failure with the uploaded file details

---

### Requirement 10: Repository Pattern for Data Access

**User Story:** As a developer, I want data access logic abstracted into repository classes, so that database queries are centralized and easily testable.

#### Acceptance Criteria

1. THE Application SHALL implement a ProductRepository class providing methods for all product queries
2. THE Application SHALL implement an OrderRepository class providing methods for all order queries
3. THE ProductRepository SHALL provide methods: all(), find(), findBySlug(), active(), byCategory(), paginated(), create(), update(), delete()
4. THE OrderRepository SHALL provide methods: all(), find(), findByOrderNumber(), pending(), byCustomerEmail(), paginated(), create(), update(), delete()
5. THE Repository classes SHALL return Eloquent collections or models, not query builders
6. THE Service_Layer classes SHALL depend on Repository classes for all data access, not models directly
7. THE Repository classes SHALL use query scopes defined in models where applicable

---

### Requirement 11: Database Migration Strategy

**User Story:** As a developer, I want a safe migration path from the current schema to the production-ready schema, so that existing data is preserved during deployment.

#### Acceptance Criteria

1. THE Application SHALL provide a migration script that creates the categories table and migrates existing category_label values
2. THE migration script SHALL create unique categories from all distinct product.category_label values in the database
3. THE migration script SHALL populate product.category_id foreign keys based on matching category names
4. THE migration script SHALL add product_id and service_id nullable foreign keys to orders table
5. THE migration script SHALL populate order.product_id by matching order.item_name with product.title where order_type is "Produk"
6. THE migration script SHALL be idempotent, allowing safe re-execution if interrupted
7. WHEN the migration completes, THE Database_Schema SHALL drop the products.category_label column

---

### Requirement 12: Production Environment Configuration

**User Story:** As a system administrator, I want production environment properly configured, so that the application runs securely and performantly in production.

#### Acceptance Criteria

1. THE Application SHALL validate that APP_ENV is set to "production" when deployed to production servers
2. THE Application SHALL validate that APP_DEBUG is set to false in production environment
3. THE Application SHALL validate that a strong APP_KEY is generated and set in production
4. THE Application SHALL configure the database driver to use MySQL or PostgreSQL in production (not SQLite)
5. THE Application SHALL configure the cache driver to use Redis or Memcached in production
6. THE Application SHALL configure the queue driver to use Redis or database in production
7. THE Application SHALL configure the session driver to use Redis or database in production
8. THE Application SHALL enable OPcache in PHP configuration for production
9. WHEN the Application boots in production, THE Application SHALL verify all required environment variables are set

---

### Requirement 13: Error Handling and Logging

**User Story:** As a developer, I want comprehensive error handling and logging, so that production issues can be diagnosed and resolved quickly.

#### Acceptance Criteria

1. THE Application SHALL log all authorization failures with user ID, resource type, and action attempted
2. THE Application SHALL log all database query failures with the SQL statement and parameters
3. THE Application SHALL log all file upload failures with file name, size, and error message
4. THE Application SHALL log all Excel import errors with row number, data, and validation error
5. THE Application SHALL log all queue job failures with job class, payload, and exception stack trace
6. WHEN an exception occurs in production, THE Application SHALL send error notifications to configured administrators
7. THE Application SHALL implement custom exception handlers for ModelNotFoundException, AuthorizationException, and ValidationException

---

### Requirement 14: API Rate Limiting

**User Story:** As a system administrator, I want API rate limiting configured, so that the application is protected from abuse and denial of service attacks.

#### Acceptance Criteria

1. THE Application SHALL apply rate limiting to all frontend order submission endpoints at 10 requests per minute per IP address
2. THE Application SHALL apply rate limiting to all authentication endpoints at 5 requests per minute per IP address
3. THE Application SHALL apply rate limiting to all admin endpoints at 60 requests per minute per authenticated user
4. WHEN a user exceeds the rate limit, THE Application SHALL return a 429 Too Many Requests response
5. THE rate limit response SHALL include Retry-After header indicating seconds until the limit resets
6. THE Application SHALL log all rate limit violations with IP address, endpoint, and timestamp

---

### Requirement 15: Database Transaction Management

**User Story:** As a developer, I want database transactions wrapping multi-step operations, so that data consistency is maintained even when operations fail partway through.

#### Acceptance Criteria

1. THE OrderService SHALL wrap order creation and related record updates in a database transaction
2. THE ProductService SHALL wrap product deletion and file cleanup in a database transaction
3. THE Excel_Import job SHALL process each Excel row within a transaction to allow row-level rollback on validation failure
4. WHEN any operation within a transaction fails, THE Database_Schema SHALL rollback all changes made in that transaction
5. THE Service_Layer classes SHALL use DB::transaction() to manage transaction boundaries
6. THE Application SHALL set the transaction isolation level to READ COMMITTED for all transactions

