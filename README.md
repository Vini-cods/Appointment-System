# Appointment System - Beauty Salon  

This project is a lightweight and efficient appointment management system for beauty salons. It provides an intuitive interface for clients to book services while allowing administrators to manage appointments effortlessly.  

## Features  

- **Client Registration:** Clients can register with their name and phone number.  
- **Service Booking:** Clients can schedule services based on availability.  
- **Appointment Management:** The dashboard displays all booked appointments, including client details, selected service, and appointment date/time.  

## Technologies Used  

- **PHP** – Back-end logic implementation.  
- **MySQL** – Database for storing clients, services, and appointments.  
- **HTML/CSS** – User interface design.  

## How It Works  

1. Clients sign up and log in.  
2. They choose a service and book an available slot.  
3. The appointment is stored in the system and can be managed via the admin dashboard.  

## Database Structure  

### `clients` `appointments` `services` Tables  
```sql
-- Table to store client information
CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,   -- Unique identifier for each client
    name VARCHAR(255) NOT NULL,           -- Client's name
    phone VARCHAR(15) NOT NULL           -- Client's phone number
);

-- Table to store services offered by the salon
CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,   -- Unique identifier for each service
    name VARCHAR(255) NOT NULL,           -- Name of the service (e.g., haircut, manicure)
    description TEXT,                     -- Description of the service
    price DECIMAL(10,2) NOT NULL          -- Price of the service
);

-- Table to store appointments made by clients
CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,   -- Unique identifier for each appointment
    client_id INT,                        -- Foreign key linked to the clients table
    service_id INT,                       -- Foreign key linked to the services table
    datetime DATETIME NOT NULL,           -- Date and time of the appointment
    status VARCHAR(20) DEFAULT 'pending', -- Status of the appointment (e.g., 'pending', 'completed')
    FOREIGN KEY (client_id) REFERENCES clients(id),  -- Link to the clients table
    FOREIGN KEY (service_id) REFERENCES services(id) -- Link to the services table
);
