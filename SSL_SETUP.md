# SSL/TLS Configuration Guide

This Laravel application is configured to use SSL/TLS encryption for secure connections.

## Features Implemented

✅ **Force HTTPS Redirect** - All HTTP requests are automatically redirected to HTTPS
✅ **Secure Cookies** - All cookies are marked as secure (HTTPS only)
✅ **HSTS Headers** - HTTP Strict Transport Security headers are set
✅ **Security Headers** - Additional security headers for protection
✅ **Proxy Trust** - Configured to trust proxy headers (for load balancers)

## Configuration

### Environment Variables

Add these to your `.env` file:

```env
# Force HTTPS (set to false for local development without SSL)
FORCE_HTTPS=true

# Secure cookies (recommended: true)
SESSION_SECURE_COOKIE=true
SECURE_COOKIES=true

# HSTS max age in seconds (31536000 = 1 year)
HSTS_MAX_AGE=31536000

# App URL should use HTTPS
APP_URL=https://yourdomain.com
```

### Local Development with SSL

For local development with SSL, you can generate a self-signed certificate:

```bash
# Generate self-signed certificate
./scripts/generate-ssl-cert.sh

# Start Laravel with HTTPS (using PHP built-in server)
php artisan serve --host=0.0.0.0 --port=8000
```

Or use a tool like [mkcert](https://github.com/FiloSottile/mkcert) for trusted local certificates:

```bash
# Install mkcert (if not already installed)
# Ubuntu/Debian:
sudo apt install libnss3-tools
# macOS:
brew install mkcert

# Generate local CA
mkcert -install

# Generate certificate for localhost
mkcert localhost 127.0.0.1 ::1
```

### Production Setup

For production, you should:

1. **Obtain SSL Certificate**
   - Use Let's Encrypt (free): `certbot --nginx` or `certbot --apache`
   - Or purchase from a trusted CA
   - Or use your hosting provider's SSL

2. **Configure Web Server**

   **Apache (.htaccess already configured):**
   ```apache
   <VirtualHost *:443>
       ServerName yourdomain.com
       DocumentRoot /path/to/public
       
       SSLEngine on
       SSLCertificateFile /path/to/certificate.crt
       SSLCertificateKeyFile /path/to/private.key
       SSLCertificateChainFile /path/to/chain.crt
   </VirtualHost>
   ```

   **Nginx:**
   ```nginx
   server {
       listen 443 ssl http2;
       server_name yourdomain.com;
       root /path/to/public;
       
       ssl_certificate /path/to/certificate.crt;
       ssl_certificate_key /path/to/private.key;
       
       location / {
           try_files $uri $uri/ /index.php?$query_string;
       }
   }
   ```

3. **Update Environment**
   ```env
   APP_URL=https://yourdomain.com
   FORCE_HTTPS=true
   SESSION_SECURE_COOKIE=true
   ```

## Security Features

### 1. Force HTTPS Middleware
- Automatically redirects HTTP to HTTPS
- Sets URL scheme for HTTPS
- Adds HSTS headers

### 2. Secure Cookies
- Cookies only sent over HTTPS
- HttpOnly flag prevents JavaScript access
- SameSite protection against CSRF

### 3. Security Headers
- `Strict-Transport-Security` - Forces HTTPS
- `X-Content-Type-Options` - Prevents MIME sniffing
- `X-Frame-Options` - Prevents clickjacking
- `X-XSS-Protection` - XSS protection
- `Referrer-Policy` - Controls referrer information

### 4. Proxy Trust
- Configured to trust proxy headers
- Works behind load balancers and reverse proxies
- Detects HTTPS from `X-Forwarded-Proto` header

## Testing SSL/TLS

### Check HTTPS Redirect
```bash
curl -I http://yourdomain.com
# Should return 301 redirect to https://
```

### Check Security Headers
```bash
curl -I https://yourdomain.com
# Should show Strict-Transport-Security and other headers
```

### Test SSL Certificate
```bash
openssl s_client -connect yourdomain.com:443 -servername yourdomain.com
```

### Online Tools
- [SSL Labs Test](https://www.ssllabs.com/ssltest/)
- [Security Headers](https://securityheaders.com/)

## Troubleshooting

### Local Development Issues

If you're having issues with HTTPS in local development:

1. **Disable HTTPS for local development:**
   ```env
   FORCE_HTTPS=false
   SESSION_SECURE_COOKIE=false
   ```

2. **Or use a trusted local certificate** (mkcert recommended)

### Production Issues

1. **Check certificate is valid:**
   ```bash
   openssl x509 -in certificate.crt -text -noout
   ```

2. **Verify web server configuration:**
   - Ensure SSL module is enabled
   - Check certificate paths are correct
   - Verify port 443 is open

3. **Check Laravel logs:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

## Notes

- The application will automatically redirect HTTP to HTTPS
- All cookies are secure by default
- HSTS is enabled with 1-year max age
- Security headers are added automatically
- Works with load balancers and reverse proxies

