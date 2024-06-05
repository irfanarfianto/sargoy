<!-- resources/views/product/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <style>

body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 16px;
}

.form-group textarea {
    height: 100px;
    resize: vertical;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    border: none;
    border-radius: 4px;
    color: white;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

.alert {
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}

.alert ul {
    margin: 0;
    padding-left: 20px;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Update Product</h1>
        <form action="{{ route('product.update', $product->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
        @method('PUT')
        <div>
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" value="{{ old('product_name', $product->product_name) }}">
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="{{ old('price', $product->price) }}">
        </div>
        <div>
            <label for="images">Images:</label>
            <input type="file" id="images" name="images[]" multiple accept="image/*">
        </div>
        <div>
            <label for="categories">Categories:</label>
            <select id="categories" name="categories[]" multiple>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->categories->contains($category) ? 'selected' : '' }}>{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit">Update Product</button>
        </div>
        </form>
    </div>
</body>
</html>