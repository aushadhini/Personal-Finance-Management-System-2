<?php
// --- show errors (only for local dev) ---
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // Set constants for paths
    define('DB_DIR', __DIR__ . '/../db');

    // Require environment and SQLite helper
    require __DIR__ . '/../config/env.php';
    require __DIR__ . '/sqlite.php';

    // Quick checks
    if (!extension_loaded('pdo_sqlite')) {
        throw new Exception('PDO_SQLITE extension is NOT enabled.');
    }
    if (!extension_loaded('sqlite3')) {
        throw new Exception('SQLITE3 extension is NOT enabled.');
    }

    // Ensure /db folder exists & is writable
    if (!is_dir(DB_DIR)) {
        if (!mkdir(DB_DIR, 0775, true)) {
            throw new Exception("Failed to create db folder: " . DB_DIR);
        }
    }

    if (!is_writable(DB_DIR)) {
        throw new Exception("db folder is not writable: " . DB_DIR);
    }

    // Create or connect to SQLite DB
    $pdo = sqlite(); // Assumes sqlite() function returns PDO instance
    $pdo->exec('PRAGMA foreign_keys = ON;');
    $pdo->beginTransaction();

    // ===== SCHEMA =====
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS USERS_LOCAL (
      local_user_id     INTEGER PRIMARY KEY AUTOINCREMENT,
      server_user_id    INTEGER,
      email             TEXT NOT NULL UNIQUE,
      password_hash     TEXT NOT NULL,
      full_name         TEXT NOT NULL,
      last_login_at     TEXT
    );
    ");

    $pdo->exec("
    CREATE TABLE IF NOT EXISTS ACCOUNTS_LOCAL (
      local_account_id  INTEGER PRIMARY KEY AUTOINCREMENT,
      user_local_id     INTEGER NOT NULL,
      server_account_id INTEGER,
      account_name      TEXT NOT NULL,
      account_type      TEXT NOT NULL CHECK(account_type IN ('CASH','BANK','CARD','MOBILE')),
      currency_code     TEXT NOT NULL DEFAULT 'LKR',
      opening_balance   REAL NOT NULL DEFAULT 0,
      is_active         INTEGER NOT NULL DEFAULT 1,
      created_at        TEXT NOT NULL,
      updated_at        TEXT NOT NULL,
      FOREIGN KEY(user_local_id) REFERENCES USERS_LOCAL(local_user_id)
    );
    ");

    $pdo->exec("
    CREATE TABLE IF NOT EXISTS CATEGORIES_LOCAL (
      local_category_id  INTEGER PRIMARY KEY AUTOINCREMENT,
      user_local_id      INTEGER NOT NULL,
      server_category_id INTEGER,
      parent_local_id    INTEGER,
      category_name      TEXT NOT NULL,
      category_type      TEXT NOT NULL CHECK(category_type IN ('INCOME','EXPENSE')),
      created_at         TEXT NOT NULL,
      updated_at         TEXT NOT NULL,
      FOREIGN KEY(user_local_id)   REFERENCES USERS_LOCAL(local_user_id),
      FOREIGN KEY(parent_local_id) REFERENCES CATEGORIES_LOCAL(local_category_id)
    );
    ");

    $pdo->exec("
    CREATE TABLE IF NOT EXISTS TRANSACTIONS_LOCAL (
      local_txn_id       INTEGER PRIMARY KEY AUTOINCREMENT,
      client_txn_uuid    TEXT NOT NULL UNIQUE,
      user_local_id      INTEGER NOT NULL,
      account_local_id   INTEGER NOT NULL,
      category_local_id  INTEGER NOT NULL,
      txn_type           TEXT NOT NULL CHECK(txn_type IN ('INCOME','EXPENSE','TRANSFER')),
      amount             REAL NOT NULL,
      txn_date           TEXT NOT NULL,
      note               TEXT,
      sync_status        TEXT NOT NULL DEFAULT 'PENDING' CHECK(sync_status IN ('PENDING','SYNCED','CONFLICT')),
      server_txn_id      INTEGER,
      created_at         TEXT NOT NULL,
      updated_at         TEXT NOT NULL,
      last_sync_at       TEXT,
      FOREIGN KEY(user_local_id)     REFERENCES USERS_LOCAL(local_user_id),
      FOREIGN KEY(account_local_id)  REFERENCES ACCOUNTS_LOCAL(local_account_id),
      FOREIGN KEY(category_local_id) REFERENCES CATEGORIES_LOCAL(local_category_id)
    );
    ");

    // ===== SEED =====
    $now = date('Y-m-d H:i:s');

    $pdo->exec("
    INSERT OR IGNORE INTO USERS_LOCAL (local_user_id, email, password_hash, full_name, last_login_at)
    VALUES (1, 'kosala@example.com', 'demo_hash_replace', 'Kosala D. Athapaththu', '$now');
    ");

    $pdo->exec("
    INSERT OR IGNORE INTO ACCOUNTS_LOCAL (local_account_id, user_local_id, account_name, account_type, currency_code, opening_balance, is_active, created_at, updated_at)
    VALUES
      (1, 1, 'Cash Wallet', 'CASH', 'LKR', 5000.00, 1, '$now', '$now'),
      (2, 1, 'People''s Bank - Savings', 'BANK', 'LKR', 25000.00, 1, '$now', '$now');
    ");

    $pdo->exec("
    INSERT OR IGNORE INTO CATEGORIES_LOCAL (local_category_id, user_local_id, category_name, category_type, created_at, updated_at)
    VALUES
      (1, 1, 'Salary', 'INCOME', '$now', '$now'),
      (3, 1, 'Food & Dining', 'EXPENSE', '$now', '$now');
    ");

    $pdo->commit();

    echo "<h2>✅ SQLite migration completed</h2>";
    echo "<p>Database file: <code>" . htmlspecialchars(SQLITE_PATH) . "</code></p>";

} catch (Throwable $e) {
    http_response_code(500);
    echo "<h2>❌ Migration failed</h2>";
    echo "<pre>" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</pre>";
}
