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