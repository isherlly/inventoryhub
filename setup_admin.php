<?php
// Simple script to create admin user using PDO
$dsn = 'mysql:host=localhost;dbname=inventory';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Generate password hash using bcrypt (Yii default)
    $passwordHash = password_hash('admin123', PASSWORD_BCRYPT);
    $authKey = bin2hex(random_bytes(16));
    $now = time();
    
    // Check if user already exists
    $stmt = $pdo->prepare("SELECT id FROM user WHERE username = ?");
    $stmt->execute(['admin']);
    
    if ($stmt->rowCount() > 0) {
        echo "User 'admin' already exists!" . PHP_EOL;
    } else {
        // Insert new user
        $stmt = $pdo->prepare("
            INSERT INTO user (username, auth_key, password_hash, email, status, created_at, updated_at)
            VALUES (?, ?, ?, ?, 10, ?, ?)
        ");
        
        $stmt->execute([
            'admin',
            $authKey,
            $passwordHash,
            'admin@example.com',
            $now,
            $now
        ]);
        
        echo "Admin user created successfully!" . PHP_EOL;
        echo "Username: admin" . PHP_EOL;
        echo "Password: admin123" . PHP_EOL;
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
?>
