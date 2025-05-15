-- SMM Panel Database Schema

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    balance DECIMAL(10, 2) DEFAULT 0.00,
    api_key VARCHAR(64) NULL,
    is_admin TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Categories Table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NULL,
    status TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Services Table
CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT NULL,
    price DECIMAL(10, 4) NOT NULL,
    min_quantity INT NOT NULL,
    max_quantity INT NOT NULL,
    service_type ENUM('Default', 'Custom Comments', 'Package', 'Subscriptions') DEFAULT 'Default',
    api_provider_id INT NULL,
    api_service_id VARCHAR(50) NULL,
    status TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- Orders Table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    service_id INT NOT NULL,
    link VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    start_count INT NULL DEFAULT 0,
    remains INT NULL DEFAULT 0,
    status ENUM('Pending', 'Processing', 'Completed', 'Partial', 'Canceled', 'Refunded') DEFAULT 'Pending',
    api_order_id VARCHAR(50) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);

-- Transactions Table
CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    type ENUM('Credit', 'Debit') NOT NULL,
    description TEXT NULL,
    txn_id VARCHAR(100) NULL,
    status ENUM('Pending', 'Completed', 'Failed') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- API Providers Table
CREATE TABLE api_providers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    url VARCHAR(255) NOT NULL,
    api_key VARCHAR(255) NOT NULL,
    balance DECIMAL(10, 2) DEFAULT 0.00,
    status TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tickets Table
CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('Open', 'Answered', 'Closed') DEFAULT 'Open',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Ticket Replies Table
CREATE TABLE ticket_replies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT NOT NULL,
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert default admin user (password: admin123)
INSERT INTO users (username, email, password, is_admin) 
VALUES ('admin', 'admin@example.com', '$2y$10$YDJ45OU0oM9xWEWsUkEtUu4hht0/CoQJWDIqnQJbTxBpZkXWHZ7Mu', 1);

-- Insert sample categories
INSERT INTO categories (name, description) VALUES 
('Instagram', 'Instagram followers, likes, and engagement services'),
('YouTube', 'YouTube views, subscribers, and engagement services'),
('Facebook', 'Facebook page likes, post likes, and followers'),
('Twitter', 'Twitter followers, retweets, and likes'),
('TikTok', 'TikTok followers, likes, and views');

-- Insert sample services
INSERT INTO services (category_id, name, description, price, min_quantity, max_quantity) VALUES 
(1, 'Instagram Followers', 'High-quality Instagram followers', 2.50, 100, 10000),
(1, 'Instagram Likes', 'Fast Instagram likes for your posts', 1.20, 50, 5000),
(2, 'YouTube Views', 'High retention YouTube views', 1.80, 1000, 100000),
(2, 'YouTube Subscribers', 'Real YouTube subscribers', 15.00, 100, 5000),
(3, 'Facebook Page Likes', 'Quality Facebook page likes', 3.50, 100, 10000),
(4, 'Twitter Followers', 'Active Twitter followers', 4.20, 100, 5000),
(5, 'TikTok Followers', 'Real TikTok followers', 5.00, 100, 10000),
(5, 'TikTok Likes', 'Fast TikTok likes', 2.00, 100, 10000);