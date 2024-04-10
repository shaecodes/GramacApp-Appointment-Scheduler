CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(64) NOT NULL, 
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL, 
    phone_number VARCHAR(20) NOT NULL,
    role VARCHAR(50) NOT NULL 
);

INSERT INTO users (email, password, first_name, last_name, phone_number, role)
VALUES ('admin@example.com','$2y$10$UqnJtQUGBPaYrDrvK2C9De2yGcbjzXJPClscxUkxj9fxtYQgf31Fi', 'Admin', 'User', '1234567890', 'admin');

INSERT INTO users (email, password, first_name, last_name, phone_number, role)
VALUES ('anotheradmin@example.com', '$2y$10$IK/VxIj7Yr3zj9XK8X6RfeXg7XpNfuvN89v4Krryq1XNXo7xA5RUS', 'Another', 'Admin', '0987654321', 'admin');
