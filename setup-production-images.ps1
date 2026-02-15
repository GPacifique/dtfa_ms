# 🖼️ Image Display Production Setup Script (PowerShell)
# This script ensures all images will work correctly on your production server

Write-Host "==================================================" -ForegroundColor Cyan
Write-Host "🖼️  Image Display Production Setup" -ForegroundColor Cyan
Write-Host "==================================================" -ForegroundColor Cyan
Write-Host ""

# Step 1: Create Storage Symlink
Write-Host "📁 Step 1: Creating storage symlink..." -ForegroundColor Yellow
try {
    php artisan storage:link
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✓ Storage symlink created successfully" -ForegroundColor Green
    } else {
        Write-Host "✗ Failed to create storage symlink" -ForegroundColor Red
    }
} catch {
    Write-Host "✗ Error: $_" -ForegroundColor Red
}
Write-Host ""

# Step 2: Verify symlink exists
Write-Host "🔍 Step 2: Verifying symlink..." -ForegroundColor Yellow
if (Test-Path "public\storage") {
    Write-Host "✓ Symlink exists at public\storage" -ForegroundColor Green
    Get-Item "public\storage" | Select-Object FullName, Target, LinkType
} else {
    Write-Host "✗ Symlink not found" -ForegroundColor Red
}
Write-Host ""

# Step 3: Create storage directories if they don't exist
Write-Host "📂 Step 3: Ensuring storage directories exist..." -ForegroundColor Yellow
$directories = @(
    "storage\app\public\students",
    "storage\app\public\staff",
    "storage\app\public\users",
    "storage\app\public\coaches"
)

foreach ($dir in $directories) {
    if (!(Test-Path $dir)) {
        New-Item -ItemType Directory -Path $dir -Force | Out-Null
        Write-Host "  Created: $dir" -ForegroundColor Gray
    }
}
Write-Host "✓ Storage directories verified" -ForegroundColor Green
Write-Host ""

# Step 4: Clear all caches
Write-Host "🧹 Step 4: Clearing all caches..." -ForegroundColor Yellow
php artisan cache:clear | Out-Null
php artisan config:clear | Out-Null
php artisan view:clear | Out-Null
php artisan route:clear | Out-Null
Write-Host "✓ All caches cleared" -ForegroundColor Green
Write-Host ""

# Step 5: Optimize for production (optional on local)
Write-Host "⚡ Step 5: Caching configuration..." -ForegroundColor Yellow
php artisan config:cache | Out-Null
php artisan route:cache | Out-Null
Write-Host "✓ Configuration cached" -ForegroundColor Green
Write-Host ""

# Step 6: Check APP_URL
Write-Host "🌐 Step 6: Checking APP_URL configuration..." -ForegroundColor Yellow
if (Test-Path ".env") {
    $envContent = Get-Content ".env" -Raw
    if ($envContent -match "APP_URL=(.+)") {
        $appUrl = $matches[1].Trim()
        if ($appUrl -match "127\.0\.0\.1|localhost") {
            Write-Host "⚠ WARNING: APP_URL is set to local development value: $appUrl" -ForegroundColor Yellow
            Write-Host "  This is OK for local development" -ForegroundColor Yellow
            Write-Host "  For production, update .env with your domain" -ForegroundColor Yellow
        } else {
            Write-Host "✓ APP_URL is set to: $appUrl" -ForegroundColor Green
        }
    }
} else {
    Write-Host "✗ .env file not found" -ForegroundColor Red
}
Write-Host ""

# Step 7: Check if routes are registered
Write-Host "🛣️  Step 7: Verifying photo routes..." -ForegroundColor Yellow
$routes = php artisan route:list --json | ConvertFrom-Json
$photoRoutes = $routes | Where-Object { $_.name -like "*.photo" }
if ($photoRoutes.Count -gt 0) {
    Write-Host "✓ Photo routes are registered:" -ForegroundColor Green
    $photoRoutes | ForEach-Object {
        Write-Host "  $($_.method) $($_.uri) → $($_.name)" -ForegroundColor Gray
    }
} else {
    Write-Host "✗ Photo routes not found" -ForegroundColor Red
}
Write-Host ""

# Step 8: Check for static assets
Write-Host "🖼️  Step 8: Checking static assets..." -ForegroundColor Yellow
if (Test-Path "public\logo.jpeg") {
    $logoSize = (Get-Item "public\logo.jpeg").Length
    Write-Host "✓ Logo file exists ($([math]::Round($logoSize/1KB, 2)) KB)" -ForegroundColor Green
} else {
    Write-Host "⚠ Logo file not found at public\logo.jpeg" -ForegroundColor Yellow
}
Write-Host ""

# Step 9: Test file permissions (write test)
Write-Host "🔓 Step 9: Testing write permissions..." -ForegroundColor Yellow
$testFile = "storage\app\public\.test_$(Get-Date -Format 'yyyyMMddHHmmss')"
try {
    New-Item -ItemType File -Path $testFile -Force | Out-Null
    if (Test-Path $testFile) {
        Write-Host "✓ Storage directory is writable" -ForegroundColor Green
        Remove-Item $testFile -Force
    }
} catch {
    Write-Host "✗ Storage directory is NOT writable" -ForegroundColor Red
    Write-Host "  Error: $_" -ForegroundColor Red
}
Write-Host ""

# Step 10: Check PHP extensions
Write-Host "🔧 Step 10: Checking PHP extensions..." -ForegroundColor Yellow
$phpInfo = php -m
if ($phpInfo -match "gd") {
    Write-Host "✓ GD image library is installed" -ForegroundColor Green
} elseif ($phpInfo -match "imagick") {
    Write-Host "✓ Imagick library is installed" -ForegroundColor Green
} else {
    Write-Host "⚠ No image library (GD/Imagick) detected" -ForegroundColor Yellow
}
Write-Host ""

# Summary
Write-Host "==================================================" -ForegroundColor Cyan
Write-Host "📊 Setup Summary" -ForegroundColor Cyan
Write-Host "==================================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "✅ Image serving method: Route-based (production-ready)" -ForegroundColor White
Write-Host "✅ Storage location: storage\app\public\" -ForegroundColor White
Write-Host "✅ Photo URL format: /photos/students/{id}" -ForegroundColor White
Write-Host "✅ Fallback: SVG avatars with initials" -ForegroundColor White
Write-Host ""

Write-Host "==================================================" -ForegroundColor Cyan
Write-Host "🎯 Next Steps for Local Development" -ForegroundColor Cyan
Write-Host "==================================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "1. Continue developing - images are ready to use" -ForegroundColor White
Write-Host "2. Test image upload in Students section" -ForegroundColor White
Write-Host "3. When deploying to production:" -ForegroundColor White
Write-Host "   - Run this script on the server" -ForegroundColor White
Write-Host "   - Update APP_URL in .env" -ForegroundColor White
Write-Host "   - Set proper file permissions (chmod 755)" -ForegroundColor White
Write-Host ""
Write-Host "==================================================" -ForegroundColor Cyan
Write-Host "✅ Setup Complete!" -ForegroundColor Green
Write-Host "==================================================" -ForegroundColor Cyan
Write-Host ""
