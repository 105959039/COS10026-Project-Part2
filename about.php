<?php
include 'config.inc';
?>
<?php 
$pageTitle = "About Our Team | QuantumAxis Engineering";
include 'header.inc';
include 'nav.inc';

// Fetch all data using the view
$pdo = getDBConnection();
$teamData = null;
$members = [];
$skills = [];

if ($pdo) {
    try {
        // Get complete team data from view
        $stmt = $pdo->query("SELECT * FROM team_complete_view WHERE team_name = 'QuantumAxis Engineering'");
        $teamData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Get detailed member information - using DISTINCT to avoid duplicates
        $memberStmt = $pdo->query("SELECT DISTINCT full_name, interests, hobbies, favorite_books FROM team_members WHERE team_id = 1");
        $members = $memberStmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Get team skills - using DISTINCT to avoid duplicates
        $skillStmt = $pdo->query("SELECT DISTINCT skill_name FROM team_skills WHERE team_id = 1");
        $skills = $skillStmt->fetchAll(PDO::FETCH_COLUMN);
        
    } catch (PDOException $e) {
        error_log("Database query failed: " . $e->getMessage());
    }
}
?>

<main>
    <section class="about_group-info">
        <h2>Group Information</h2>
        <div class="about_nested-list">
            <ul>
                <li>Group Name: <?php echo htmlspecialchars($teamData['team_name'] ?? 'QuantumAxis Engineering'); ?></li>
                <li>Class Details:
                    <ul>
                        <li>Time: <?php echo htmlspecialchars($teamData['class_time'] ?? '12:00-2:00 PM'); ?></li>
                        <li>Day: <?php echo htmlspecialchars($teamData['class_day'] ?? 'Wednesday'); ?></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="about_student-ids">
            Student IDs: <?php echo htmlspecialchars($teamData['student_ids'] ?? '105728022, 105959039, 106218155, 1054683299'); ?>
        </div>
        <p><strong>Tutor's Name:</strong> <?php echo htmlspecialchars($teamData['tutor_name'] ?? 'Ms. Pawani T. Rasaratnam'); ?></p>
    </section>
    
    <section class="about_contributions">
        <h2>Members Contribution</h2>
        <dl>
            <dt>Wong Jia Lun</dt>
            <dd>PHP Home page, CSS Styling, Job Application, PHP Manage</dd>

            <dt>Shariar Oasib Shikto</dt>
            <dd>PHP Job Description, CSS Styling, PHP Enhancement</dd>

            <dt>Ng Ting Xuan</dt>
            <dd></dd>

            <dt>Mohammad Fatin Anjum Fahim</dt>
            <dd>PHP About page, CSS Styling, Validation, Login/Logout</dd>
        </dl>
    </section>
    
    <section class="about_group-photo">
        <h2>Our Team</h2>
        <figure class="team-photo">
            <img 
                src="images/groupAssignmentPhoto.jpg" 
                alt="Group Photo of AI/ML Engineering team members"
            >
            <figcaption>
                <?php echo htmlspecialchars($teamData['photo_caption'] ?? 'Our amazing team: Fatin, Shikto, Xuan, Jia'); ?>
            </figcaption>
        </figure>
        <p>
            At QuantumAxis Engineering, we're more than just a team—we're a collaborative unit where diverse perspectives converge to create exceptional web solutions. Each member brings unique strengths to our projects, from meticulous front-end design to robust back-end architecture. Our shared commitment to continuous learning, agile methodologies, and user-centered design enables us to tackle complex challenges and transform ideas into polished, functional digital experiences that make a lasting impact.
        </p>
    </section>
    
    <section class="about_interests">
        <h2>Members Interests</h2>
        <table>
            <caption>Team Interests and Hobbies</caption>
            <thead>
                <tr><th>Name</th><th>Interests</th><th>Hobbies</th><th>Favorite Books</th></tr>
            </thead>
            <tbody>
                <?php if (!empty($members)): ?>
                    <?php 
                    // Remove duplicate members by name to ensure no duplicates
                    $uniqueMembers = [];
                    foreach ($members as $member) {
                        $uniqueMembers[$member['full_name']] = $member;
                    }
                    ?>
                    <?php foreach ($uniqueMembers as $member): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($member['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($member['interests']); ?></td>
                            <td><?php echo htmlspecialchars($member['hobbies']); ?></td>
                            <td><?php echo htmlspecialchars($member['favorite_books']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Fallback data without duplication - only 4 unique members -->
                    <tr><td>Wong Jia Lun</td><td>HTML/CSS</td><td>Making Latte Art</td><td>I Had That Same Dream Again</td></tr>
                    <tr><td>Ng Ting Xuan</td><td>Web Development</td><td>Collecting Frog Keychains</td><td>Historical Books</td></tr>
                    <tr><td>Shariar Oasib Shikto</td><td>Machine Learning</td><td>Playing Cricket</td><td>Sherlock Holmes</td></tr>
                    <tr><td>Mohammad Fatin Anjum Fahim</td><td>Back-end Development</td><td>Singing, Playing Guitar</td><td>The Secret by Rhonda Byrne</td></tr>
                <?php endif; ?>
                <tr class="about_team-skills">
                    <td colspan="4" style="text-align: center;">
                        Shared Team Skills: <?php 
                            // Remove duplicate skills and display unique ones only
                            $uniqueSkills = array_unique($skills);
                            echo htmlspecialchars(implode(', ', $uniqueSkills) ?: 'HTML5, CSS3, JavaScript, Python, UI/UX Design'); 
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
    
    <section>
        <h2>Additional Information</h2>
        <h3>Our Skills</h3>
        <p>Our team possesses a diverse set of skills including <?php 
            $uniqueSkills = array_unique($skills);
            echo htmlspecialchars(implode(', ', $uniqueSkills) ?: 'HTML5, CSS3, JavaScript, Python, Machine Learning, UI/UX design, and project management'); 
        ?>.</p>
        
        <h3>Our Hometowns</h3>
        <p>Our team represents a fusion of international and local perspectives. Fatin and Shikto contribute their Bangladeshi heritage and global outlook, while Jia and Ting Xuan provide Malaysian local expertise and cultural understanding. This combination enables us to develop web solutions that balance international standards with regional relevance.</p>
    </section>
</main>

<?php 
if (isset($pdo)) {
    $pdo = null;
}
include 'footer.inc'; 
?>