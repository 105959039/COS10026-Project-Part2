<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$page_title = "QuantumAxis Engineering - Career Opportunities";

// Include database configuration
include 'config.inc';

// Get all jobs from database
$jobs = getAllJobs();
$jobCount = count($jobs);

// Include header
include 'header.inc';
// Include menu
include 'nav.inc';
?>

<div class="jobs_container">
    <div class="jobs_job-count">
        <strong><?php echo $jobCount; ?> Job Position<?php echo $jobCount !== 1 ? 's' : ''; ?> Available</strong>
    </div>
    
    <div class="jobs_content-wrapper">
        <div class="jobs_main-content">
            <?php if ($jobCount > 0): ?>
                <?php foreach ($jobs as $job): ?>
                    <?php
                    // Decode JSON arrays
                    $responsibilities = json_decode($job['responsibilities'], true) ?: [];
                    $essentialQualifications = json_decode($job['essential_qualifications'], true) ?: [];
                    $preferableQualifications = json_decode($job['preferable_qualifications'], true) ?: [];
                    ?>
                    
                    <section class="jobs_section">
                        <h2 class="jobs_h2"><i class="<?php echo htmlspecialchars($job['icon_class']); ?>"></i> <?php echo htmlspecialchars($job['title']); ?></h2>
                        <div class="jobs_decorative-bar"></div>
                        <p><strong>Reference Number:</strong> <?php echo htmlspecialchars($job['reference_number']); ?></p>

                        <h3 class="jobs_h3">Position Overview</h3>
                        <p><?php echo htmlspecialchars($job['overview']); ?></p>

                        <div class="jobs_highlight">
                            <p><strong>Job type:</strong> <?php echo htmlspecialchars($job['job_type']); ?></p>
                            <p><strong>Category:</strong> <?php echo htmlspecialchars($job['category']); ?></p>
                            <p><strong>Salary Range:</strong> <?php echo htmlspecialchars($job['salary_range']); ?></p>
                            <p><strong>Reports To:</strong> <?php echo htmlspecialchars($job['reports_to']); ?></p>
                        </div>

                        <?php if (!empty($responsibilities)): ?>
                        <h3 class="jobs_h3">Key Responsibilities</h3>
                        <ul>
                            <?php foreach ($responsibilities as $responsibility): ?>
                                <li><?php echo htmlspecialchars($responsibility); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <?php if (!empty($essentialQualifications)): ?>
                        <h3 class="jobs_h3">Required Qualifications</h3>
                        <h4 class="jobs_h4">Essential</h4>
                        <ol>
                            <?php foreach ($essentialQualifications as $qualification): ?>
                                <li><?php echo htmlspecialchars($qualification); ?></li>
                            <?php endforeach; ?>
                        </ol>
                        <?php endif; ?>

                        <?php if (!empty($preferableQualifications)): ?>
                        <h4 class="jobs_h4">Preferable</h4>
                        <ul>
                            <?php foreach ($preferableQualifications as $qualification): ?>
                                <li><?php echo htmlspecialchars($qualification); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </section>
                <?php endforeach; ?>
            <?php else: ?>
                <section class="jobs_section">
                    <h2 class="jobs_h2">No Job Positions Available</h2>
                    <p>Currently, there are no open positions. Please check back later for new opportunities.</p>
                </section>
            <?php endif; ?>
        </div>

        <!-- Aside Section for Additional Information -->
        <div class="jobs_aside-container">
            <aside class="jobs_aside">
                <h3><i class="fas fa-lightbulb"></i> Application Tips</h3>
                <p>To improve your chances of being selected, make sure to:</p>
                <ul>
                    <li>Tailor your resume for the specific role.</li>
                    <li>Highlight your technical skills and certifications.</li>
                    <li>Provide clear examples of past projects or achievements.</li>
                    <li>Prepare for both technical and behavioral interview questions.</li>
                </ul>
                
                <h3><i class="fas fa-star"></i> Why Join Us?</h3>
                <p>We offer competitive salaries, excellent benefits, and opportunities for professional growth in a dynamic environment.</p>
                
                <h3><i class="fas fa-envelope"></i> Contact HR</h3>
                <p>Email: quantumaxis212@gmail.com <br>Phone: 016-334 7378</p>
            </aside>
        </div>
    </div>
</div>
<?php include('footer.inc'); ?>