#!/bin/bash

# Image Display Fix - Production Deployment Script
# Run this on your Namecheap server

echo "🖼️ Image Display Fix - Production Deployment"
echo "=============================================="
echo ""

cd ~/sportacademyms || exit 1

echo "✅ Step 1: Backing up current .env..."
cp .env .env.backup.$(date +%Y%m%d_%H%M%S)

echo "✅ Step 2: Pulling latest code from GitHub..."
git pull origin main

echo "✅ Step 3: Updating .env configuration..."
# Add or update FILESYSTEM_DISK setting
if grep -q "FILESYSTEM_DISK" .env; then
    sed -i 's/FILESYSTEM_DISK=.*/FILESYSTEM_DISK=public/' .env
    echo "   - Updated existing FILESYSTEM_DISK to public"
elif grep -q "FILESYSTEM_DRIVER" .env; then
    sed -i 's/FILESYSTEM_DRIVER=.*/FILESYSTEM_DISK=public/' .env
    echo "   - Changed FILESYSTEM_DRIVER to FILESYSTEM_DISK=public"
else
    echo "" >> .env
    echo "FILESYSTEM_DISK=public" >> .env
    echo "   - Added FILESYSTEM_DISK=public to .env"
fi

echo "✅ Step 4: Ensuring storage symlink exists..."
php artisan storage:link 2>&1 | grep -v "already exists" || true

echo "✅ Step 5: Clearing all caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo "✅ Step 6: Setting proper permissions..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache
[ -d public/storage ] && chmod -R 755 public/storage

echo "✅ Step 7: Verifying image files..."
STUDENT_PHOTOS=$(ls storage/app/public/photos/students/ 2>/dev/null | wc -l)
echo "   - Found $STUDENT_PHOTOS student photo files"

echo ""
echo "=============================================="
echo "✅ Deployment Complete!"
echo ""
echo "📋 Next Steps:"
echo "1. Test image display on student pages"
echo "2. Check staff member photos"
echo "3. Verify user profile pictures"
echo ""
echo "🔍 If images still don't show:"
echo "   - Clear your browser cache"
echo "   - Try opening in incognito/private window"
echo "   - Check browser console for 404 errors"
echo ""
