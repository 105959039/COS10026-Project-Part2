<?php
// process_eoi.php
// Handles form submission from apply.php and inserts data into the database

// ---------- DATABASE CONNECTION ----------
require_once 'config.inc'; // Make sure this defines $servername, $username, $password, $dbname

// ---------- HELPER FUNCTIONS ----------

// Clean input to prevent XSS
function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Calculate age accurately
function calculate_age($dob) {
    $birth_date = new DateTime($dob);
    $today = new DateTime();
    return $today->diff($birth_date)->y;
}

// ---------- VALIDATION ----------
$errors = [];

// Required fields
$expected_fields = [
    'refnum', 'firstname', 'lastname', 'bday', 'gender',
    'streetaddress', 'suburb_town', 'state_territory',
    'postcode', 'email', 'phone'
];

foreach ($expected_fields as $field) {
    if (empty($_POST[$field])) {
        $errors[] = "Missing field: $field";
    }
}

// Assign + clean inputs
$refnum          = clean_input($_POST['refnum'] ?? '');
$firstname       = clean_input($_POST['firstname'] ?? '');
$lastname        = clean_input($_POST['lastname'] ?? '');
$bday            = clean_input($_POST['bday'] ?? '');
$gender          = clean_input($_POST['gender'] ?? '');
$streetaddress   = clean_input($_POST['streetaddress'] ?? '');
$suburb_town     = clean_input($_POST['suburb_town'] ?? '');
$state_territory = clean_input($_POST['state_territory'] ?? '');
$postcode        = clean_input($_POST['postcode'] ?? '');
$email           = clean_input($_POST['email'] ?? '');
$phone           = clean_input($_POST['phone'] ?? '');
$techlist        = $_POST['techlist'] ?? [];
$other_skills    = clean_input($_POST['other_skills'] ?? '');

// ---------- ADDITIONAL VALIDATION ----------

// Name validation
if (!preg_match("/^[A-Za-z\s]{1,20}$/", $firstname)) {
    $errors[] = "Invalid first name. Only letters and spaces allowed, max 20 characters.";
}
if (!preg_match("/^[A-Za-z\s]{1,20}$/", $lastname)) {
    $errors[] = "Invalid last name. Only letters and spaces allowed, max 20 characters.";
}

// Postcode
if (!preg_match("/^\d{4}$/", $postcode)) {
    $errors[] = "Postcode must be exactly 4 digits.";
}

// Phone
if (!preg_match("/^[0-9 ]{8,12}$/", $phone)) {
    $errors[] = "Phone must be 8–12 digits/spaces only.";
}

// Email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email address.";
}

// Job reference
$allowed_refnums = ['AI123', 'CS456', 'DS789'];
if (!in_array($refnum, $allowed_refnums)) {
    $errors[] = "Invalid job reference number.";
}

// State validation
$allowed_states = ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'];
if (!in_array($state_territory, $allowed_states)) {
    $errors[] = "Invalid state selected.";
}

// Gender validation
$allowed_genders = ['Male', 'Female', 'Other'];
if (!in_array($gender, $allowed_genders)) {
    $errors[] = "Invalid gender selected.";
}

// Age validation (minimum 23)
if (!empty($bday)) {
    $birth_date = DateTime::createFromFormat('Y-m-d', $bday);
    if (!$birth_date) {
        $errors[] = "Invalid date format.";
    } else {
        $age = calculate_age($bday);
        if ($age < 23) {
            $errors[] = "You must be at least 23 years old. Current age: {$age} years.";
        }
        if ($birth_date > new DateTime()) {
            $errors[] = "Date of birth cannot be in the future.";
        }
    }
}

// At least one tech skill
if (empty($techlist)) {
    $errors[] = "You must select at least 1 technical skill.";
}

// Convert techlist to JSON
$techlist_json = !empty($techlist) ? json_encode($techlist) : '[]';
if ($techlist_json === false) {
    $techlist_json = '[]';
}

// ---------- DISPLAY ERRORS ----------
if (!empty($errors)) {
    echo "<div class='container'><div class='form-container'>";
    echo "<h2>Submission Errors</h2><ul class='error-list'>";
    foreach ($errors as $e) {
        echo "<li>$e</li>";
    }
    echo "</ul>";
    echo "<a href='apply.php' class='submit-btn'>Go Back</a>";
    echo "</div></div>";
    include 'footer.inc';
    exit();
}

// ---------- INSERT INTO DATABASE ----------
$sql = "INSERT INTO eoi 
        (refnum, firstname, lastname, bday, gender, streetaddress, suburb_town, 
         state_territory, postcode, email, phone, techlist, other_skills)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("<p class='error'>Database preparation error: " . $conn->error . "</p>");
}

$stmt->bind_param(
    "sssssssssssss",
    $refnum, $firstname, $lastname, $bday, $gender, $streetaddress, $suburb_town,
    $state_territory, $postcode, $email, $phone, $techlist_json, $other_skills
);

if ($stmt->execute()) {
    echo "<div class='container'><div class='form-container'>";
    echo "<h1>EOI Submitted Successfully!</h1>";
    echo "<p>Thank you, <strong>$firstname</strong>. Your application has been recorded.</p>";
    echo "<a href='apply.php' class='submit-btn'>Submit Another</a>";
    echo "</div></div>";
} else {
    echo "<p class='error'>Error inserting record: " . $conn->error . "</p>";
}

$stmt->close();
$conn->close();

include 'footer.inc';
?>
