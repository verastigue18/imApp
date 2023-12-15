<?php

class Order {
    private $db;
    private $user_id;

    public function __construct($db, $user_id) {
        $this->db = $db;
        $this->user_id = $user_id;
    }

    public function createNewOrder($customer_id, $product_id, $quantity, $status, $total_order) {
        $query = "INSERT INTO orders (customer_id, product_id, quantity, status, total_order, user_id) VALUES (:customer_id, :product_id, :quantity, :status, :total_order, :user_id)";
        $stmt = $this->db->conn->prepare($query);
        
        $params = [
            ':customer_id' => $customer_id,
            ':product_id' => $product_id,
            ':quantity' => $quantity,
            ':status' => $status,
            ':total_order' => $total_order,
            ':user_id' => $this->user_id,
        ];        
    
        return $stmt->execute($params);
    }
    
    public function getAllOrders() {
        $query = "SELECT * FROM orders WHERE user_id = :user_id";
        $stmt = $this->db->conn->prepare($query);

        $params = [':user_id' => $this->user_id];

        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function getOrderById($order_id) {
        $query = "SELECT * FROM orders WHERE id = :order_id && user_id = :user_id";
        $stmt = $this->db->conn->prepare($query);

        $params = [
            ':order_id' => $order_id,
            ':user_id' => $this->user_id
        ];

        $stmt->execute($params);

        return $stmt->fetch();
    }

    public function getOrdersWithDetails() {
        $query = "SELECT o.*, c.customer_name, p.product_name, p.price
                  FROM orders o
                  JOIN customers c ON o.customer_id = c.id
                  JOIN products p ON o.product_id = p.id
                  WHERE o.user_id = :user_id";
        $stmt = $this->db->conn->prepare($query);
        $params = [':user_id' => $this->user_id];
        $stmt->execute($params);
    
        return $stmt->fetchAll();
    }

    public function getActiveCustomers() {
        $query = "SELECT * FROM customers WHERE status = 'active' AND user_id = :user_id";
        $stmt = $this->db->conn->prepare($query);

        $params = [':user_id' => $this->user_id];

        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function getTotalOrders() {
        $query = "SELECT COUNT(*) as total_orders FROM orders WHERE user_id = :user_id";
        $stmt = $this->db->conn->prepare($query);

        $params = [':user_id' => $this->user_id];

        $stmt->execute($params);

        $result = $stmt->fetch();
        return $result['total_orders'];
    }

    public function getTotalSales() {
        $query = "SELECT SUM(products.price * orders.quantity) as total_sales
                  FROM orders
                  INNER JOIN products ON orders.product_id = products.id
                  WHERE orders.user_id = :user_id";
        $stmt = $this->db->conn->prepare($query);

        $params = [':user_id' => $this->user_id];

        $stmt->execute($params);

        $result = $stmt->fetch();
        return $result['total_sales'];
    }

    public function getAllOrdersCount() {
        $query = "SELECT COUNT(*) as total_orders FROM orders WHERE user_id = :user_id";
        $stmt = $this->db->conn->prepare($query);

        $params = [
            ':user_id' => $this->user_id,
        ];

        $stmt->execute($params);

        $result = $stmt->fetch();
        return $result['total_orders'];
    }

    public function getTotalOrdersByStatus($status) {
        $query = "SELECT COUNT(*) as total_orders FROM orders WHERE status = :status AND user_id = :user_id";
        $stmt = $this->db->conn->prepare($query);

        $params = [
            ':status' => $status,
            ':user_id' => $this->user_id
        ];

        $stmt->execute($params);

        $result = $stmt->fetch();
        return $result['total_orders'];
    }

    public function getCompleteOrdersCount() {
        return $this->getTotalOrdersByStatus('complete');
    }

    public function getInProgressOrdersCount() {
        return $this->getTotalOrdersByStatus('in_progress');
    }

    public function getPendingOrdersCount() {
        return $this->getTotalOrdersByStatus('pending');
    }

    public function updateOrder($customer_id, $product_id, $quantity, $total_order, $status, $order_id) {
        $query = "UPDATE orders SET customer_id = :customer_id, product_id = :product_id, quantity = :quantity, total_order = :total_order, status = :status WHERE id = :order_id AND user_id = :user_id";
        $stmt = $this->db->conn->prepare($query);
    
        $params = [
            ':customer_id' => (int)$customer_id, 
            ':product_id' => (int)$product_id,    
            ':quantity' => (int)$quantity,       
            ':total_order' => (float)$total_order, 
            ':status' => $status,
            ':order_id' => (int)$order_id,        
            ':user_id' => $this->user_id,
        ];
    
        $stmt->execute($params);

        if ($status == 'complete') {
            $this->updateProductQuantity($product_id, $quantity);
        }

        return true;
    }
    
    public function deleteOrderById($order_id) {
        $query = 'DELETE FROM orders WHERE id = :order_id AND user_id = :user_id';
        $stmt = $this->db->conn->prepare($query);

        $params = [
            ':order_id' => $order_id,
            ':user_id' => $this->user_id
        ];

        $stmt->execute($params);

        return $stmt->fetch();
    }

    public function getTopCustomers($limit = 5) {
        $query = "SELECT c.customer_name, COUNT(o.id) as order_count
                  FROM orders o
                  JOIN customers c ON o.customer_id = c.id
                  WHERE o.user_id = :user_id
                  GROUP BY o.customer_id
                  ORDER BY order_count DESC
                  LIMIT :limit";
    
        $stmt = $this->db->conn->prepare($query);
        $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll();
    }

    private function updateProductQuantity($product_id, $quantity) {
        $currentQuantity = $this->getProductQuantity($product_id);
    
        $newQuantity = max(0, $currentQuantity - (int)$quantity); 
    
        $updateQuery = "UPDATE products SET quantity = :new_quantity WHERE id = :product_id";
        $updateStmt = $this->db->conn->prepare($updateQuery);
    
        $updateParams = [
            ':new_quantity' => $newQuantity,
            ':product_id' => $product_id,
        ];
    
        $updateStmt->execute($updateParams);
    }

    public function getProductQuantity($product_id) {
        $query = "SELECT quantity FROM products WHERE id = :product_id AND user_id = :user_id";
        $stmt = $this->db->conn->prepare($query);
    
        $params = [
            ':product_id' => $product_id,
            ':user_id' => $this->user_id
        ];
    
        $stmt->execute($params);
    
        $result = $stmt->fetch();
    
        return $result ? $result['quantity'] : null;
    }
    
}
