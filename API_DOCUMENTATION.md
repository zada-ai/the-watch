# THE WATCH API Documentation

## Base URL
```
http://localhost:8000/api
```

## Endpoints

### 1. Get All Products
**GET** `/products`

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Premium Chrono X1",
            "category": "watches",
            "price": 12999,
            "original_price": 18999,
            "description": "Premium build, water resistant, 2-year warranty",
            "images": ["url1", "url2", "url3"],
            "colors": ["#111827", "#b45309", "#0369a1"],
            "discount": 31,
            "active": true,
            "created_at": "2026-02-02T...",
            "updated_at": "2026-02-02T..."
        }
    ],
    "message": "Products retrieved successfully"
}
```

---

### 2. Get Products by Category
**GET** `/products/category/{category}`

**Categories:** `watches`, `headphones`, `airbuds`

**Example:**
```
GET /api/products/category/watches
```

**Response:**
```json
{
    "success": true,
    "data": [...],
    "category": "watches",
    "count": 3,
    "message": "Products retrieved successfully"
}
```

---

### 3. Get Featured Products
**GET** `/products/featured/{category?}`

**Example (with category):**
```
GET /api/products/featured/watches
```

**Example (all categories):**
```
GET /api/products/featured
```

**Response:** Returns up to 6 products

---

### 4. Get Single Product
**GET** `/products/{id}`

**Example:**
```
GET /api/products/1
```

**Response:**
```json
{
    "success": true,
    "data": {...},
    "message": "Product retrieved successfully"
}
```

---

### 5. Create Product (Protected)
**POST** `/products`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: application/json
```

**Request Body:**
```json
{
    "name": "New Watch",
    "category": "watches",
    "price": 9999,
    "original_price": 14999,
    "description": "Amazing watch",
    "images": ["url1", "url2", "url3"],
    "colors": ["#111827", "#b45309"],
    "discount": 33,
    "active": true
}
```

**Response:** Returns created product with 201 status

---

### 6. Update Product (Protected)
**PUT** `/products/{id}`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: application/json
```

**Request Body:** (all fields optional)
```json
{
    "name": "Updated Name",
    "price": 10999,
    "discount": 25
}
```

---

### 7. Delete Product (Protected)
**DELETE** `/products/{id}`

**Headers:**
```
Authorization: Bearer {token}
```

---

## Testing with cURL

### Get all products:
```bash
curl -X GET "http://localhost:8000/api/products"
```

### Get watches:
```bash
curl -X GET "http://localhost:8000/api/products/category/watches"
```

### Get single product:
```bash
curl -X GET "http://localhost:8000/api/products/1"
```

### Create product (with auth):
```bash
curl -X POST "http://localhost:8000/api/products" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "New Product",
    "category": "watches",
    "price": 9999,
    "original_price": 14999,
    "description": "Test",
    "images": ["url1"],
    "discount": 20,
    "active": true
  }'
```

---

## Setup Instructions

1. **Run Migration:**
```bash
php artisan migrate
```

2. **Seed Data:**
```bash
php artisan db:seed --class=ProductSeeder
```

3. **Test API:**
Open Postman or any API client and test the endpoints

---

## Database Structure

**Table:** `products`

| Column | Type | Notes |
|--------|------|-------|
| id | integer | Primary Key |
| name | string | Product name |
| category | string | watches/headphones/airbuds |
| price | integer | Current price in Rs |
| original_price | integer | Original price (nullable) |
| description | text | Product description |
| images | json | Array of image URLs |
| colors | json | Array of hex color codes |
| discount | integer | Discount percentage (0-100) |
| active | boolean | Is product active |
| created_at | timestamp | Created date |
| updated_at | timestamp | Updated date |

---

## Error Responses

### Not Found (404):
```json
{
    "success": false,
    "message": "Product not found"
}
```

### Validation Error (422):
```json
{
    "message": "Validation failed",
    "errors": {
        "name": ["The name field is required"],
        "price": ["The price field is required"]
    }
}
```

### Unauthorized (401):
```json
{
    "message": "Unauthenticated"
}
```

---

## Next Steps

1. Run `php artisan migrate`
2. Run `php artisan db:seed --class=ProductSeeder`
3. Test API endpoints with Postman
4. Integrate API calls in your frontend with axios/fetch
5. Update CollapsibleTabs.blade.php to use API endpoints instead of hardcoded data
