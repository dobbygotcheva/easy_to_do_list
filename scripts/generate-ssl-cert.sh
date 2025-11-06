#!/bin/bash

# Generate self-signed SSL certificate for local development
# This script creates a self-signed certificate for HTTPS testing

echo "Generating self-signed SSL certificate for local development..."

# Create certificates directory
mkdir -p storage/certs

# Generate private key
openssl genrsa -out storage/certs/server.key 2048

# Generate certificate signing request
openssl req -new -key storage/certs/server.key -out storage/certs/server.csr \
    -subj "/C=US/ST=State/L=City/O=Organization/CN=localhost"

# Generate self-signed certificate (valid for 365 days)
openssl x509 -req -days 365 -in storage/certs/server.csr -signkey storage/certs/server.key \
    -out storage/certs/server.crt -extensions v3_req -extfile <(
cat <<EOF
[req]
distinguished_name = req_distinguished_name
req_extensions = v3_req

[v3_req]
keyUsage = keyEncipherment, dataEncipherment
extendedKeyUsage = serverAuth
subjectAltName = @alt_names

[alt_names]
DNS.1 = localhost
DNS.2 = *.localhost
IP.1 = 127.0.0.1
IP.2 = ::1
EOF
)

# Set proper permissions
chmod 600 storage/certs/server.key
chmod 644 storage/certs/server.crt

echo "SSL certificate generated successfully!"
echo "Certificate: storage/certs/server.crt"
echo "Private Key: storage/certs/server.key"
echo ""
echo "To use with PHP built-in server:"
echo "  php -S localhost:8000 -t public storage/certs/server.crt storage/certs/server.key"
echo ""
echo "Or configure your web server (Apache/Nginx) to use these certificates."

