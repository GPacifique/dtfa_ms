# 🔧 Fix Git Merge Conflict on Production Server

## Problem
```bash
error: Your local changes to the following files would be overwritten by merge:
        composer.lock
Please commit your changes or stash them before you merge.
```

## Solution

You have three options:

---

### Option 1: Stash Local Changes (Recommended)

This temporarily saves your local changes and applies the remote changes:

```bash
cd ~/dtfa_updated

# Stash (save) your local changes
git stash

# Pull the latest changes
git pull origin main

# Optional: If you want to restore your local changes after pulling
git stash pop
```

**Best for:** When you want to keep both your local changes and remote changes.

---

### Option 2: Discard Local Changes

This throws away your local `composer.lock` changes and uses the remote version:

```bash
cd ~/dtfa_updated

# Discard local changes to composer.lock
git checkout -- composer.lock

# Pull the latest changes
git pull origin main
```

**Best for:** When your local `composer.lock` changes are not important (usually the case).

---

### Option 3: Commit Local Changes First

This keeps your local changes in a commit before pulling:

```bash
cd ~/dtfa_updated

# Add the changed file
git add composer.lock

# Commit with a message
git commit -m "Update composer.lock on production"

# Pull the latest changes (may require merge)
git pull origin main
```

**Best for:** When you intentionally modified composer.lock on production.

---

## 🎯 Recommended Steps for Your Situation

Since `composer.lock` is usually auto-generated and the local change is likely from running `composer install` on the server, I recommend **Option 2**:

```bash
# Step 1: Navigate to your app directory
cd ~/dtfa_updated

# Step 2: Discard local composer.lock changes
git checkout -- composer.lock

# Step 3: Pull latest code
git pull origin main

# Step 4: Run composer install to regenerate composer.lock for production
composer install --no-dev --optimize-autoloader

# Step 5: Run migrations if needed
php artisan migrate

# Step 6: Clear and cache
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🔍 Why This Happened

The `composer.lock` file was modified on the production server (possibly by running `composer install` or `composer update`). When you tried to pull changes from GitHub that also include `composer.lock` updates, Git detected a conflict.

---

## 📝 After Pulling Successfully

Once you've pulled the latest code, make sure to:

1. ✅ Run `composer install` to install new packages (like Cloudinary)
2. ✅ Create storage symlink: `php artisan storage:link`
3. ✅ Set permissions:
   ```bash
   chmod -R 755 storage
   chmod -R 755 bootstrap/cache
   chmod -R 755 public/storage
   ```
4. ✅ Clear caches: `php artisan config:clear && php artisan cache:clear`
5. ✅ Test photo URLs in browser

---

## 🆘 If You Still Have Issues

If you encounter more conflicts:

```bash
# Reset to remote version (⚠️ WARNING: This discards ALL local changes)
git fetch origin
git reset --hard origin/main

# Then reinstall dependencies
composer install --no-dev --optimize-autoloader
```

---

**Last Updated:** December 3, 2025
