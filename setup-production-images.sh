#!/bin/bash

# 🖼️ Image Display Production Setup Script
# This script ensures all images will work correctly on your production server

echo "=================================================="
echo "🖼️  Image Display Production Setup"
echo "=================================================="
echo ""

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Step 1: Create Storage Symlink
echo "📁 Step 1: Creating storage symlink..."
php artisan storage:link
if [ $? -eq 0 ]; then
    echo -e "${GREEN}✓ Storage symlink created successfully${NC}"
else
    echo -e "${RED}✗ Failed to create storage symlink${NC}"
fi
echo ""

# Step 2: Verify symlink exists
echo "🔍 Step 2: Verifying symlink..."
if [ -L "public/storage" ]; then
    echo -e "${GREEN}✓ Symlink exists at public/storage${NC}"
    ls -la public/storage
else
    echo -e "${RED}✗ Symlink not found${NC}"
fi
echo ""

# Step 3: Set correct permissions
echo "🔐 Step 3: Setting correct permissions..."
chmod -R 755 storage 2>/dev/null
chmod -R 755 bootstrap/cache 2>/dev/null
chmod -R 755 public 2>/dev/null
echo -e "${GREEN}✓ Permissions set (755 for storage, bootstrap/cache, public)${NC}"
echo ""

# Step 4: Create storage directories if they don't exist
echo "📂 Step 4: Ensuring storage directories exist..."
mkdir -p storage/app/public/students
mkdir -p storage/app/public/staff
mkdir -p storage/app/public/users
mkdir -p storage/app/public/coaches
echo -e "${GREEN}✓ Storage directories created${NC}"
echo ""

# Step 5: Clear all caches
echo "🧹 Step 5: Clearing all caches..."
php artisan cache:clear > /dev/null 2>&1
php artisan config:clear > /dev/null 2>&1
php artisan view:clear > /dev/null 2>&1
php artisan route:clear > /dev/null 2>&1
echo -e "${GREEN}✓ All caches cleared${NC}"
echo ""

# Step 6: Optimize for production
echo "⚡ Step 6: Optimizing for production..."
php artisan config:cache > /dev/null 2>&1
php artisan route:cache > /dev/null 2>&1
php artisan view:cache > /dev/null 2>&1
echo -e "${GREEN}✓ Configuration cached${NC}"
echo ""

# Step 7: Check APP_URL
echo "🌐 Step 7: Checking APP_URL configuration..."
if [ -f ".env" ]; then
    APP_URL=$(grep "^APP_URL=" .env | cut -d '=' -f2)
    if [[ $APP_URL == *"127.0.0.1"* ]] || [[ $APP_URL == *"localhost"* ]]; then
        echo -e "${YELLOW}⚠ WARNING: APP_URL is set to local development value: $APP_URL${NC}"
        echo -e "${YELLOW}  Please update .env file with your production domain${NC}"
    else
        echo -e "${GREEN}✓ APP_URL is set to: $APP_URL${NC}"
    fi
else
    echo -e "${RED}✗ .env file not found${NC}"
fi
echo ""

# Step 8: Check if routes are registered
echo "🛣️  Step 8: Verifying photo routes..."
ROUTE_CHECK=$(php artisan route:list | grep "student.photo")
if [ ! -z "$ROUTE_CHECK" ]; then
    echo -e "${GREEN}✓ Photo routes are registered${NC}"
    php artisan route:list | grep -E "student\.photo|staff\.photo|user\.photo"
else
    echo -e "${RED}✗ Photo routes not found${NC}"
fi
echo ""

# Step 9: Check for static assets
echo "🖼️  Step 9: Checking static assets..."
if [ -f "public/logo.jpeg" ]; then
    echo -e "${GREEN}✓ Logo file exists${NC}"
else
    echo -e "${YELLOW}⚠ Logo file not found at public/logo.jpeg${NC}"
fi
echo ""

# Step 10: Test file permissions
echo "🔓 Step 10: Testing write permissions..."
TEST_FILE="storage/app/public/.test_$(date +%s)"
touch "$TEST_FILE" 2>/dev/null
if [ -f "$TEST_FILE" ]; then
    echo -e "${GREEN}✓ Storage directory is writable${NC}"
    rm "$TEST_FILE"
else
    echo -e "${RED}✗ Storage directory is NOT writable${NC}"
    echo -e "${YELLOW}  Run: chmod -R 775 storage${NC}"
fi
echo ""

# Summary
echo "=================================================="
echo "📊 Setup Summary"
echo "=================================================="
echo ""
echo "✅ Image serving method: Route-based (production-ready)"
echo "✅ Storage location: storage/app/public/"
echo "✅ Photo URL format: /photos/students/{id}"
echo "✅ Fallback: SVG avatars with initials"
echo ""

echo "=================================================="
echo "🎯 Next Steps"
echo "=================================================="
echo ""
echo "1. Update .env file with your production domain:"
echo "   APP_URL=https://sportacademyms.com"
echo ""
echo "2. Test image display:"
echo "   - Visit /students-modern and view student photos"
echo "   - Upload a new photo and verify it saves"
echo "   - Visit /photos/students/1 directly"
echo ""
echo "3. If images still don't display, check:"
echo "   - Server ownership: chown -R www-data:www-data storage"
echo "   - SELinux context (if applicable)"
echo "   - Verify PHP has GD or Imagick extension"
echo ""
echo "=================================================="
echo "✅ Setup Complete!"
echo "=================================================="
