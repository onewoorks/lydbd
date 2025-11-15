<?php
// Simple test runner for project (no external deps)
echo "Running tests...\n";
try {
    require_once __DIR__ . '/ProductModelTest.php';
    echo "All tests passed.\n";
    exit(0);
} catch (Throwable $e) {
    echo "Test failed: " . $e->getMessage() . "\n";
    exit(1);
}
