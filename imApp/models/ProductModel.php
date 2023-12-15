<?php 

class Product {
    private $db;
    private $user_id;

    public function __construct($db, $user_id) {
        $this->db = $db;
        $this->user_id = $user_id;
    }

    public function createNewProduct($product_name, $price, $quantity, $description, $image) {
        $query = "INSERT INTO products (product_name, price, quantity, description, image, user_id) VALUES (:product_name, :price, :quantity, :description, :image, :user_id)";
        $stmt = $this->db->conn->prepare($query);
    
        $params = [
            ':product_name' => $product_name,
            ':price' => $price,
            ':quantity' => $quantity,
            ':description' => $description,
            ':image' => $image,
            ':user_id' => $this->user_id
        ];
    
        return $stmt->execute($params);
    }
    
    public function getAllProducts() {
        $query = "SELECT * FROM products WHERE user_id = :user_id";
        $stmt = $this->db->conn->prepare($query);

        $params = [':user_id' => $this->user_id];

        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function getProductById ($product_id) {
        $query = "SELECT * FROM products WHERE id = :product_id && user_id = :user_id";
        $stmt = $this->db->conn->prepare($query);

        $params = [
            ':product_id' => $product_id,
            ':user_id' => $this->user_id
        ];

        $stmt->execute($params);

        return $stmt->fetch();
    }

    public function getProductsAvailable() {
        $query = "SELECT * FROM products WHERE quantity > 0 AND user_id = :user_id";
        $stmt = $this->db->conn->prepare($query);
    
        $params = [':user_id' => $this->user_id];
    
        $stmt->execute($params);
    
        return $stmt->fetchAll();
    }

    public function getLowQuantityProducts()
    {
        $query = "SELECT * FROM products WHERE quantity < 10";
        $stmt = $this->db->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function updateProductByData($product_name, $price, $quantity, $description, $product_id) {
        $query = "UPDATE products SET product_name = :product_name, price = :price, quantity = :quantity, description = :description WHERE id = :product_id && user_id = :user_id";
    
        $stmt = $this->db->conn->prepare($query);
    
        $params = [
            ':product_name' => $product_name,
            ':price' => $price,
            ':quantity' => $quantity,
            ':description' => $description,
            ':product_id' => $product_id,
            ':user_id' => $this->user_id,
        ];

        return $stmt->execute($params);
    }

    public function updateProductByImage($product_id, $image) {
        $query ="UPDATE products SET image = :image WHERE id = :product_id && user_id = :user_id";
        $stmt = $this->db->conn->prepare($query);
        
        $params = [
            ':image' => $image,
            ':product_id' => $product_id,
            ':user_id' => $this->user_id,
        ];

        return $stmt->execute($params);
    }
    
    public function deleteProductById($product_id) {
        $query = 'DELETE FROM products WHERE id = :product_id AND user_id = :user_id';
        $stmt = $this->db->conn->prepare($query);

        $params = [
            ':product_id' => $product_id,
            ':user_id' => $this->user_id
        ];

        $stmt->execute($params);

        return $stmt->fetch();
    }
}