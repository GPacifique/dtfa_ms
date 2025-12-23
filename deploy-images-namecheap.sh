#!/bin/bash

# ========================================
# Image Display Fix for Namecheap Production
# ========================================

echo "🚀 Deploying Image Fix to Namecheap Production"
echo "================================================"
echo ""

# Change to your project directory
cd ~/sportacademyms || exit 1

echo "✅ Step 1: Pull latest code from GitHub..."
git pull origin main

echo "✅ Step 2: Update .env - Check APP_URL..."
echo ""
echo "⚠️  IMPORTANT: Verify your APP_URL in .env file"
echo "   Example: APP_URL=https://sportacademyms.app.avanciafitness.com"
echo ""
read -p "Press Enter after confirming APP_URL is correct..."

echo "✅ Step 3: Ensure FILESYSTEM_DISK is set to public..."
if grep -q "FILESYSTEM_DISK" .env; then
    sed -i 's/FILESYSTEM_DISK=.*/FILESYSTEM_DISK=public/' .env
else
    echo "FILESYSTEM_DISK=public" >> .env
fi

echo "✅ Step 4: Try creating storage symlink..."
php artisan storage:link 2>&1 || echo "   (Symlink may fail on shared hosting - that's OK!)"

echo "✅ Step 5: Clear all Laravel caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo "✅ Step 6: Cache optimizations for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Step 7: Set proper file permissions..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache
find storage -type f -exec chmod 664 {} \;
find bootstrap/cache -type f -exec chmod 664 {} \;

echo "✅ Step 8: Verify storage directory structure..."
mkdir -p storage/app/public/photos/students
mkdir -p storage/app/public/photos/staff
chmod -R 775 storage/app/public

echo "✅ Step 9: Count uploaded images..."
STUDENT_COUNT=$(find storage/app/public/photos/students -type f 2>/dev/null | wc -l)
echo "   Found $STUDENT_COUNT student photos"

echo ""
echo "================================================"
echo "✅ Deployment Complete!"
echo "================================================"
echo ""
echo "🔍 Testing Steps:"
echo "1. Visit your website: $APP_URL"
echo "2. Go to Students page"
echo "3. Check if images are visible"
echo "4. If images DON'T show, check browser console (F12)"
echo ""
echo "📝 How the Fix Works:"
echo "   - Your app now has a /storage/* route proxy"
echo "   - Even if public/storage symlink fails, images will load"
echo "   - The proxy serves files from storage/app/public/"
echo ""
echo "🐛 Troubleshooting:"
echo "   - Check .env has correct APP_URL"
echo "   - Verify files exist: ls -la storage/app/public/photos/students/"
echo "   - Check Laravel logs: tail -f storage/logs/laravel.log"
echo ""
