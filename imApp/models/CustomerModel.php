<?php 

class Customer {
    private $db;
    private $user_id;

    public function __construct($db, $user_id) {
        $this->db = $db;
        $this->user_id = $user_id;
    }

    public function createNewCustomer($customer_name, $email, $phone, $address, $status) {
        $query = "INSERT INTO customers (customer_name, email, phone, address, status, user_id) VALUES (:customer_name, :email, :phone, :address, :status, :user_id)";
        $stmt = $this->db->conn->prepare($query);

        $params = [
            ':customer_name' => $customer_name,
            ':email' => $email,
            ':phone' => $phone,
            ':address' => $address,
            ':status' => $status,
            ':user_id' => $this->user_id
        ];

        return $stmt->execute($params);
    }

    public function getAllCustomers() {
        $query = "SELECT * FROM customers WHERE user_id = :user_id";
        $stmt = $this->db->conn->prepare($query);

        $params = [':user_id' => $this->user_id];

        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function getCustomerById ($customer_id) {
        $query = "SELECT * FROM customers WHERE id = :customer_id && user_id = :user_id";
        $stmt = $this->db->conn->prepare($query);

        $params = [
            ':customer_id' => $customer_id,
            ':user_id' => $this->user_id
        ];

        $stmt->execute($params);

        return $stmt->fetch();
    }

    public function getCustomerCounts() {
        $query = "SELECT
                    COUNT(*) as total_customers,
                    SUM(CASE WHEN status = 'active' THEN 1 ELSE 0 END) as total_active,
                    SUM(CASE WHEN status = 'inactive' THEN 1 ELSE 0 END) as total_inactive
                  FROM customers
                  WHERE user_id = :user_id";
    
        $stmt = $this->db->conn->prepare($query);
    
        $params = [':user_id' => $this->user_id];
    
        $stmt->execute($params);
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return [
            'total_customers' => $result['total_customers'],
            'total_active' => $result['total_active'],
            'total_inactive' => $result['total_inactive'],
        ];
    }

    public function getNewlyRegisteredCustomers()
    {
        $query = "SELECT * FROM customers WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 5";
        $stmt = $this->db->conn->prepare($query);

        $params = [':user_id' => $this->user_id];

        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function updateCustomer($customer_name, $email, $phone, $address, $status, $customer_id) {
        $query = "UPDATE customers SET customer_name = :customer_name, email = :email, phone = :phone, address = :address, status = :status WHERE id = :customer_id AND user_id = :user_id";
        $stmt = $this->db->conn->prepare($query);
    
        $params = [
            ':customer_name' => $customer_name,
            ':email' => $email,
            ':phone' => $phone,
            ':address' => $address,
            ':status' => $status,
            ':customer_id' => $customer_id,
            ':user_id' => $this->user_id,
        ];
    
        return $stmt->execute($params);
    }

    public function deleteCustomerById($customer_id) {
        $query = 'DELETE FROM customers WHERE id = :customer_id AND user_id = :user_id';
        $stmt = $this->db->conn->prepare($query);

        $params = [
            ':customer_id' => $customer_id,
            ':user_id' => $this->user_id
        ];

        $stmt->execute($params);

        return $stmt->fetch();
    }

    public function getActiveCustomers() {
        $query = "SELECT * FROM customers WHERE status = 'active' AND user_id = :user_id";
        $stmt = $this->db->conn->prepare($query);

        $params = [':user_id' => $this->user_id];

        $stmt->execute($params);

        return $stmt->fetchAll();
    }
}