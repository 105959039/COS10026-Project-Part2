<?php
// manage.php - HR Manager Portal
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Simple authentication check
if (!isset($_SESSION['manager_logged_in']) || $_SESSION['manager_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Include database settings
include 'settings.php';

// Page variables
$page_title = "QuantumAxis Engineering - HR Manager Portal";
$current_page = 'manage';

// Initialize variables
$search_term = '';
$search_type = 'all';
$results = [];
$message = '';
$error = '';

// Sorting variables
$sort_field = $_GET['sort'] ?? 'submission_date';
$sort_order = $_GET['order'] ?? 'DESC';
$allowed_sort_fields = ['id', 'firstname', 'lastname', 'status', 'submission_date', 'refnum'];

// Validate sort parameters
if (!in_array($sort_field, $allowed_sort_fields)) {
    $sort_field = 'submission_date';
}
$sort_order = ($sort_order === 'ASC') ? 'ASC' : 'DESC';

// Create database connection
$conn = mysqli_connect($host, $user, $pswd, $dbnm);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if EOI table exists and has status column
checkEOITable($conn);

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Search for EOIs
    if (isset($_POST['search'])) {
        $search_term = trim($_POST['search_term']);
        $search_type = $_POST['search_type'];
        
        if ($search_type === 'all' || !empty($search_term)) {
            $results = searchEOIs($conn, $search_term, $search_type, $sort_field, $sort_order);
        }
    }
    
    // Delete EOIs by job reference
    elseif (isset($_POST['delete_eois'])) {
        $ref_to_delete = trim($_POST['ref_to_delete']);
        if (!empty($ref_to_delete)) {
            $deleted_count = deleteEOIsByReference($conn, $ref_to_delete);
            if ($deleted_count > 0) {
                $message = "Successfully deleted $deleted_count EOI(s) with reference number: $ref_to_delete";
                // Refresh results after deletion
                $results = getAllEOIs($conn, $sort_field, $sort_order);
            } else {
                $error = "No EOIs found with reference number: $ref_to_delete";
            }
        } else {
            $error = "Please enter a job reference number to delete.";
        }
    }
    
    // Update EOI status
    elseif (isset($_POST['update_status'])) {
        $eoi_id = intval($_POST['eoi_id']);
        $new_status = $_POST['new_status'];
        
        if (updateEOIStatus($conn, $eoi_id, $new_status)) {
            $message = "Successfully updated EOI #$eoi_id status to: $new_status";
            // Refresh results after status update
            if ($search_type === 'all' || empty($search_term)) {
                $results = getAllEOIs($conn, $sort_field, $sort_order);
            } else {
                $results = searchEOIs($conn, $search_term, $search_type, $sort_field, $sort_order);
            }
        } else {
            $error = "Failed to update EOI status.";
        }
    }
}

// If no search performed, show all EOIs
if (empty($results) && !isset($_POST['search'])) {
    $results = getAllEOIs($conn, $sort_field, $sort_order);
}

// Include header and navigation
include 'header.inc';
include 'nav.inc';
?>

<style>
/* Modern CSS Styles for HR Manager Portal */
.manage-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.manage-header {
    text-align: center;
    margin-bottom: 40px;
    padding: 30px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.manage-header h1 {
    margin: 0;
    font-size: 2.5em;
    font-weight: 300;
}

.manage-header p {
    margin: 10px 0 0 0;
    font-size: 1.2em;
    opacity: 0.9;
}

/* Alert Messages */
.alert {
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 25px;
    font-weight: 500;
    border-left: 5px solid;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border-left-color: #28a745;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    border-left-color: #dc3545;
}

/* Search and Action Sections */
.search-section, .action-section {
    background: white;
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 25px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    border: 1px solid #eaeaea;
}

.search-section h2, .action-section h2 {
    color: #2c3e50;
    margin-bottom: 20px;
    font-weight: 600;
    font-size: 1.4em;
    border-bottom: 2px solid #f8f9fa;
    padding-bottom: 10px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 2fr auto;
    gap: 20px;
    align-items: end;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: 600;
    margin-bottom: 8px;
    color: #495057;
    font-size: 0.95em;
}

.form-group select, .form-group input {
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 1em;
    transition: all 0.3s ease;
    background: white;
}

.form-group select:focus, .form-group input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

/* Buttons */
.btn {
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    font-size: 1em;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    text-align: center;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 7px 20px rgba(102, 126, 234, 0.4);
}

.btn-danger {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
}

.btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 7px 20px rgba(245, 87, 108, 0.4);
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

.btn-warning {
    background: #ffc107;
    color: #212529;
}

.btn-warning:hover {
    background: #e0a800;
    transform: translateY(-2px);
}

.btn-small {
    padding: 8px 15px;
    font-size: 0.9em;
}

/* Results Section */
.results-section {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    margin-bottom: 25px;
}

.results-section h2 {
    color: #2c3e50;
    margin-bottom: 20px;
    font-weight: 600;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.result-count {
    background: #667eea;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8em;
    font-weight: 500;
}

.no-results {
    text-align: center;
    padding: 40px;
    color: #6c757d;
    font-style: italic;
}

/* Table Styles */
.table-container {
    overflow-x: auto;
    border-radius: 10px;
    border: 1px solid #eaeaea;
}

.eoi-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 1000px;
}

.eoi-table th {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 15px 12px;
    text-align: left;
    font-weight: 600;
    font-size: 0.9em;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    cursor: pointer;
    transition: background 0.3s ease;
    position: relative;
}

.eoi-table th:hover {
    background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
}

.eoi-table th.sortable {
    padding-right: 25px;
}

.eoi-table th .sort-indicator {
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 0.8em;
}

.eoi-table td {
    padding: 15px 12px;
    border-bottom: 1px solid #eaeaea;
    vertical-align: top;
}

.eoi-table tr:hover {
    background: #f8f9fa;
}

.eoi-table tr:last-child td {
    border-bottom: none;
}

/* Status Badges */
.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8em;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-new {
    background: #e3f2fd;
    color: #1976d2;
}

.status-current {
    background: #fff3e0;
    color: #f57c00;
}

.status-final {
    background: #e8f5e8;
    color: #388e3c;
}

/* Status Form */
.status-form {
    display: flex;
    gap: 8px;
    align-items: center;
}

.status-select {
    padding: 6px 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 0.9em;
    background: white;
}

/* Quick Actions */
.quick-actions {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    text-align: center;
}

.quick-actions h2 {
    color: #2c3e50;
    margin-bottom: 20px;
    font-weight: 600;
}

.action-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

/* Sorting Controls */
.sorting-controls {
    background: #f8f9fa;
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    border-left: 4px solid #667eea;
}

.sorting-controls h3 {
    margin: 0 0 10px 0;
    color: #495057;
    font-size: 1em;
    font-weight: 600;
}

.sort-options {
    display: flex;
    gap: 15px;
    align-items: center;
    flex-wrap: wrap;
}

.sort-option {
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 8px 12px;
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    text-decoration: none;
    color: #495057;
    font-size: 0.9em;
    transition: all 0.3s ease;
}

.sort-option:hover {
    background: #667eea;
    color: white;
    border-color: #667eea;
}

.sort-option.active {
    background: #667eea;
    color: white;
    border-color: #667eea;
}

/* Responsive Design */
@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .manage-header h1 {
        font-size: 2em;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
    }
    
    .status-form {
        flex-direction: column;
        gap: 5px;
    }
    
    .sort-options {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .sort-option {
        width: 100%;
        justify-content: space-between;
    }
}

/* Animation for new content */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.eoi-table tbody tr {
    animation: fadeIn 0.5s ease;
}

/* Skills display */
.skills {
    max-width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.other-skills {
    max-width: 200px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    cursor: help;
}
</style>

<div class="manage-container">
    <div class="manage-header">
        <h1>HR Manager Portal</h1>
        <p>Manage Expressions of Interest</p>
        <p style="font-size: 1em; margin-top: 10px; opacity: 0.8;">Welcome, <?php echo htmlspecialchars($_SESSION['manager_username'] ?? 'Manager'); ?>!</p>
    </div>

    <!-- Display Messages -->
    <?php if (!empty($message)): ?>
        <div class="alert alert-success">✅ <?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    
    <?php if (!empty($error)): ?>
        <div class="alert alert-error">⚠️ <?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <!-- Search Section -->
    <div class="search-section">
        <h2>🔍 Search EOIs</h2>
        <form method="post" class="search-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="search_type">Search Type</label>
                    <select name="search_type" id="search_type">
                        <option value="all" <?php echo $search_type === 'all' ? 'selected' : ''; ?>>All EOIs</option>
                        <option value="refnum" <?php echo $search_type === 'refnum' ? 'selected' : ''; ?>>Job Reference</option>
                        <option value="name" <?php echo $search_type === 'name' ? 'selected' : ''; ?>>Applicant Name</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="search_term">Search Term</label>
                    <input type="text" name="search_term" id="search_term" 
                           value="<?php echo htmlspecialchars($search_term); ?>" 
                           placeholder="Enter search term...">
                </div>
                
                <div class="form-group">
                    <button type="submit" name="search" class="btn btn-primary">🔍 Search</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Delete EOIs Section -->
    <div class="action-section">
        <h2>🗑️ Delete EOIs by Job Reference</h2>
        <form method="post" class="delete-form" onsubmit="return confirm('⚠️ Are you sure you want to delete all EOIs with this reference number? This action cannot be undone.');">
            <div class="form-row">
                <div class="form-group">
                    <label for="ref_to_delete">Job Reference Number</label>
                    <input type="text" name="ref_to_delete" id="ref_to_delete" 
                           placeholder="e.g., AI123" maxlength="10" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="delete_eois" class="btn btn-danger">🗑️ Delete All Matching EOIs</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Results Section -->
    <div class="results-section">
        <h2>
            <?php 
            if ($search_type === 'all') {
                echo "📋 All EOIs";
            } elseif ($search_type === 'refnum') {
                echo "🎯 EOIs for Job Reference: " . htmlspecialchars($search_term);
            } else {
                echo "👤 EOIs for Applicant: " . htmlspecialchars($search_term);
            }
            ?>
            <span class="result-count"><?php echo count($results); ?> found</span>
        </h2>

        <!-- Sorting Controls -->
        <div class="sorting-controls">
            <h3>📊 Sort By:</h3>
            <div class="sort-options">
                <a href="?sort=submission_date&order=<?php echo $sort_field === 'submission_date' && $sort_order === 'DESC' ? 'ASC' : 'DESC'; ?>" 
                   class="sort-option <?php echo $sort_field === 'submission_date' ? 'active' : ''; ?>">
                    📅 Date <?php echo $sort_field === 'submission_date' ? ($sort_order === 'DESC' ? '↓' : '↑') : ''; ?>
                </a>
                <a href="?sort=id&order=<?php echo $sort_field === 'id' && $sort_order === 'DESC' ? 'ASC' : 'DESC'; ?>" 
                   class="sort-option <?php echo $sort_field === 'id' ? 'active' : ''; ?>">
                    # ID <?php echo $sort_field === 'id' ? ($sort_order === 'DESC' ? '↓' : '↑') : ''; ?>
                </a>
                <a href="?sort=firstname&order=<?php echo $sort_field === 'firstname' && $sort_order === 'DESC' ? 'ASC' : 'DESC'; ?>" 
                   class="sort-option <?php echo $sort_field === 'firstname' ? 'active' : ''; ?>">
                    👤 First Name <?php echo $sort_field === 'firstname' ? ($sort_order === 'DESC' ? '↓' : '↑') : ''; ?>
                </a>
                <a href="?sort=lastname&order=<?php echo $sort_field === 'lastname' && $sort_order === 'DESC' ? 'ASC' : 'DESC'; ?>" 
                   class="sort-option <?php echo $sort_field === 'lastname' ? 'active' : ''; ?>">
                    👥 Last Name <?php echo $sort_field === 'lastname' ? ($sort_order === 'DESC' ? '↓' : '↑') : ''; ?>
                </a>
                <a href="?sort=status&order=<?php echo $sort_field === 'status' && $sort_order === 'DESC' ? 'ASC' : 'DESC'; ?>" 
                   class="sort-option <?php echo $sort_field === 'status' ? 'active' : ''; ?>">
                    🏷️ Status <?php echo $sort_field === 'status' ? ($sort_order === 'DESC' ? '↓' : '↑') : ''; ?>
                </a>
                <a href="?sort=refnum&order=<?php echo $sort_field === 'refnum' && $sort_order === 'DESC' ? 'ASC' : 'DESC'; ?>" 
                   class="sort-option <?php echo $sort_field === 'refnum' ? 'active' : ''; ?>">
                    🔖 Job Ref <?php echo $sort_field === 'refnum' ? ($sort_order === 'DESC' ? '↓' : '↑') : ''; ?>
                </a>
            </div>
        </div>

        <?php if (empty($results)): ?>
            <p class="no-results">No EOIs found matching your criteria.</p>
        <?php else: ?>
            <div class="table-container">
                <table class="eoi-table">
                    <thead>
                        <tr>
                            <th class="sortable" onclick="window.location.href='?sort=id&order=<?php echo $sort_field === 'id' && $sort_order === 'DESC' ? 'ASC' : 'DESC'; ?>'">
                                ID
                                <span class="sort-indicator">
                                    <?php echo $sort_field === 'id' ? ($sort_order === 'DESC' ? '↓' : '↑') : ''; ?>
                                </span>
                            </th>
                            <th class="sortable" onclick="window.location.href='?sort=refnum&order=<?php echo $sort_field === 'refnum' && $sort_order === 'DESC' ? 'ASC' : 'DESC'; ?>'">
                                Job Ref
                                <span class="sort-indicator">
                                    <?php echo $sort_field === 'refnum' ? ($sort_order === 'DESC' ? '↓' : '↑') : ''; ?>
                                </span>
                            </th>
                            <th class="sortable" onclick="window.location.href='?sort=firstname&order=<?php echo $sort_field === 'firstname' && $sort_order === 'DESC' ? 'ASC' : 'DESC'; ?>'">
                                Applicant
                                <span class="sort-indicator">
                                    <?php echo $sort_field === 'firstname' ? ($sort_order === 'DESC' ? '↓' : '↑') : ''; ?>
                                </span>
                            </th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Skills</th>
                            <th>Other Skills</th>
                            <th class="sortable" onclick="window.location.href='?sort=status&order=<?php echo $sort_field === 'status' && $sort_order === 'DESC' ? 'ASC' : 'DESC'; ?>'">
                                Status
                                <span class="sort-indicator">
                                    <?php echo $sort_field === 'status' ? ($sort_order === 'DESC' ? '↓' : '↑') : ''; ?>
                                </span>
                            </th>
                            <th class="sortable" onclick="window.location.href='?sort=submission_date&order=<?php echo $sort_field === 'submission_date' && $sort_order === 'DESC' ? 'ASC' : 'DESC'; ?>'">
                                Submitted
                                <span class="sort-indicator">
                                    <?php echo $sort_field === 'submission_date' ? ($sort_order === 'DESC' ? '↓' : '↑') : ''; ?>
                                </span>
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $eoi): ?>
                            <tr>
                                <td><strong>#<?php echo htmlspecialchars($eoi['id']); ?></strong></td>
                                <td><code><?php echo htmlspecialchars($eoi['refnum']); ?></code></td>
                                <td>
                                    <strong><?php echo htmlspecialchars($eoi['firstname'] . ' ' . $eoi['lastname']); ?></strong>
                                </td>
                                <td><?php echo htmlspecialchars($eoi['email']); ?></td>
                                <td><?php echo htmlspecialchars($eoi['phone']); ?></td>
                                <td>
                                    <?php
                                    $skills = $eoi['techlist'];
                                    if (!empty($skills)) {
                                        echo '<div class="skills">' . htmlspecialchars($skills) . '</div>';
                                    } else {
                                        echo '<span style="color: #6c757d; font-style: italic;">None</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if (!empty($eoi['other_skills'])): ?>
                                        <div class="other-skills" title="<?php echo htmlspecialchars($eoi['other_skills']); ?>">
                                            <?php echo htmlspecialchars(substr($eoi['other_skills'], 0, 50) . '...'); ?>
                                        </div>
                                    <?php else: ?>
                                        <span style="color: #6c757d; font-style: italic;">None</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="status-badge status-<?php echo strtolower($eoi['status'] ?? 'New'); ?>">
                                        <?php echo htmlspecialchars($eoi['status'] ?? 'New'); ?>
                                    </span>
                                </td>
                                <td><?php echo date('d/m/Y H:i', strtotime($eoi['submission_date'])); ?></td>
                                <td>
                                    <form method="post" class="status-form">
                                        <input type="hidden" name="eoi_id" value="<?php echo $eoi['id']; ?>">
                                        <select name="new_status" class="status-select">
                                            <option value="New" <?php echo ($eoi['status'] ?? 'New') === 'New' ? 'selected' : ''; ?>>New</option>
                                            <option value="Current" <?php echo ($eoi['status'] ?? 'New') === 'Current' ? 'selected' : ''; ?>>Current</option>
                                            <option value="Final" <?php echo ($eoi['status'] ?? 'New') === 'Final' ? 'selected' : ''; ?>>Final</option>
                                        </select>
                                        <button type="submit" name="update_status" class="btn btn-primary btn-small">Update</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h2>⚡ Quick Actions</h2>
        <div class="action-buttons">
            <a href="manage.php" class="btn btn-secondary">🔄 Show All EOIs</a>
            <a href="enhancements.php" class="btn btn-primary">🚀 View Enhancements</a>
            <a href="logout.php" class="btn btn-warning">🚪 Logout</a>
        </div>
    </div>
</div>

<?php
// Close database connection
mysqli_close($conn);
include 'footer.inc';
?>

<?php
// Database Functions

/**
 * Check and repair EOI table if needed
 */
function checkEOITable($conn) {
    // Check if status column exists
    $check_sql = "SHOW COLUMNS FROM eoi LIKE 'status'";
    $result = mysqli_query($conn, $check_sql);
    
    if (!$result || mysqli_num_rows($result) === 0) {
        // Add status column if it doesn't exist
        $alter_sql = "ALTER TABLE eoi ADD COLUMN status ENUM('New', 'Current', 'Final') DEFAULT 'New'";
        mysqli_query($conn, $alter_sql);
    }
}

/**
 * Get all EOIs from the database with sorting
 */
function getAllEOIs($conn, $sort_field = 'submission_date', $sort_order = 'DESC') {
    $allowed_fields = ['id', 'firstname', 'lastname', 'status', 'submission_date', 'refnum'];
    $sort_field = in_array($sort_field, $allowed_fields) ? $sort_field : 'submission_date';
    $sort_order = $sort_order === 'ASC' ? 'ASC' : 'DESC';
    
    $sql = "SELECT * FROM eoi ORDER BY $sort_field $sort_order";
    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        error_log("Database error: " . mysqli_error($conn));
        return [];
    }
    
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Search EOIs based on type and term with sorting
 */
function searchEOIs($conn, $search_term, $search_type, $sort_field = 'submission_date', $sort_order = 'DESC') {
    $search_term = mysqli_real_escape_string($conn, $search_term);
    $allowed_fields = ['id', 'firstname', 'lastname', 'status', 'submission_date', 'refnum'];
    $sort_field = in_array($sort_field, $allowed_fields) ? $sort_field : 'submission_date';
    $sort_order = $sort_order === 'ASC' ? 'ASC' : 'DESC';
    
    switch ($search_type) {
        case 'all':
            $sql = "SELECT * FROM eoi ORDER BY $sort_field $sort_order";
            break;
            
        case 'refnum':
            $sql = "SELECT * FROM eoi WHERE refnum LIKE '%$search_term%' ORDER BY $sort_field $sort_order";
            break;
            
        case 'name':
            $sql = "SELECT * FROM eoi 
                    WHERE firstname LIKE '%$search_term%' 
                       OR lastname LIKE '%$search_term%' 
                    ORDER BY $sort_field $sort_order";
            break;
            
        default:
            return [];
    }
    
    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        error_log("Search error: " . mysqli_error($conn));
        return [];
    }
    
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Delete all EOIs with a specific job reference number
 */
function deleteEOIsByReference($conn, $refnum) {
    $refnum = mysqli_real_escape_string($conn, $refnum);
    
    // First, count how many will be deleted
    $count_sql = "SELECT COUNT(*) as count FROM eoi WHERE refnum = '$refnum'";
    $count_result = mysqli_query($conn, $count_sql);
    
    if (!$count_result) {
        return 0;
    }
    
    $count_row = mysqli_fetch_assoc($count_result);
    $count = $count_row['count'];
    
    if ($count > 0) {
        $delete_sql = "DELETE FROM eoi WHERE refnum = '$refnum'";
        $delete_result = mysqli_query($conn, $delete_sql);
        
        if ($delete_result && mysqli_affected_rows($conn) > 0) {
            return $count;
        }
    }
    
    return 0;
}

/**
 * Update the status of a specific EOI
 */
function updateEOIStatus($conn, $eoi_id, $new_status) {
    $eoi_id = intval($eoi_id);
    $new_status = mysqli_real_escape_string($conn, $new_status);
    
    $allowed_statuses = ['New', 'Current', 'Final'];
    if (!in_array($new_status, $allowed_statuses)) {
        return false;
    }
    
    $sql = "UPDATE eoi SET status = '$new_status' WHERE id = $eoi_id";
    return mysqli_query($conn, $sql);
}
?>