<?php
// apply.php - Job Application Form
include 'header.inc';  // Contains opening <html>, <head>, <body> with navigation
include 'style.inc';   // Contains all CSS
?>

<div class="container">
    <div class="form-container">
        <h1>Job Application Form</h1>

        <form name="Job Application" id="jobapp" action="process_eoi.php" method='post'>
            <div class="form-section">
                <h3 class="form-section-title">Position Information</h3>
                <div class="form-group">
                    <label for="refnum" class="required">Job Reference Number</label>
                    <select name="refnum" id="refnum">
                        <option value="" disabled selected hidden>Select a reference number</option>
                        <option value="AI123">AI123</option>
                        <option value="CS456">CS456</option>
                        <option value="DS789">DS789</option>
                    </select>
                </div>
            </div>

            <div class="form-section">
                <h3 class="form-section-title">Personal Information</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstname" class="required">First Name</label>
                        <input type="text" id="firstname" name="firstname" maxlength="20">
                    </div>

                    <div class="form-group">
                        <label for="lastname" class="required">Last Name</label>
                        <input type="text" id="lastname" name="lastname" maxlength="20">
                    </div>
                </div>

                <div class="form-group">
                    <label for="bday" class="required">Date of Birth</label>
                    <input type="date" id="bday" name="bday">
                </div>

                <div class="form-group">
                    <fieldset>
                        <legend class="fieldset-legend required">Gender</legend>
                        <div class="radio-group">
                            <label><input type="radio" name="gender" value="Male"> Male</label>
                            <label><input type="radio" name="gender" value="Female"> Female</label>
                            <label><input type="radio" name="gender" value="Other"> Other</label>
                        </div>
                    </fieldset>
                </div>
            </div>

            <div class="form-section">
                <h3 class="form-section-title">Contact Information</h3>
                <div class="form-group">
                    <label for="streetaddress" class="required">Street Address</label>
                    <input type="text" id="streetaddress" name="streetaddress" maxlength="40">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="suburb_town" class="required">Suburb/Town</label>
                        <input type="text" id="suburb_town" name="suburb_town" maxlength="40">
                    </div>

                    <div class="form-group">
                        <label for="state_territory" class="required">State</label>
                        <select name="state_territory" id="state_territory">
                            <option value="" disabled selected hidden>Select state</option>
                            <option value="VIC">VIC</option>
                            <option value="NSW">NSW</option>
                            <option value="QLD">QLD</option>
                            <option value="NT">NT</option>
                            <option value="WA">WA</option>
                            <option value="SA">SA</option>
                            <option value="TAS">TAS</option>
                            <option value="ACT">ACT</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="postcode" class="required">Postcode</label>
                    <input type="text" id="postcode" name="postcode" maxlength="4">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email" class="required">Email</label>
                        <input type="email" id="email" name="email">
                    </div>

                    <div class="form-group">
                        <label for="phone" class="required">Phone</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3 class="form-section-title">Skills & Qualifications</h3>
                <div class="form-group">
                    <fieldset>
                        <legend class="fieldset-legend required">Required Technical Skills</legend>
                        <div class="checkbox-group">
                            <label><input type="checkbox" name="techlist[]" value="cybsec"> Cybersecurity</label>
                            <label><input type="checkbox" name="techlist[]" value="datasci"> Data Scientist</label>
                            <label><input type="checkbox" name="techlist[]" value="webdev"> Web Development</label>
                            <label><input type="checkbox" name="techlist[]" value="artint"> Artificial Intelligence</label>
                            <label><input type="checkbox" name="techlist[]" value="cloud"> Cloud Computing</label>
                            <label><input type="checkbox" name="techlist[]" value="ml"> Machine Learning</label>
                        </div>
                    </fieldset>
                </div>

                <div class="other-skills-container">
                    <div class="other-skills-textarea">
                        <label for="other_skills">Other Skills (Optional)</label>
                        <textarea id="other_skills" name="other_skills" 
                                  placeholder="Please describe any other skills or qualifications you have..."
                                  class="large-textarea"></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="submit-btn">Apply</button>
        </form>
    </div>

    <div class="social-links">
        <a href="https://www.facebook.com/profile.php?id=61580514305943" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/quantumaxis/" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-linkedin-in"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
    </div>
</div>

<?php
include 'footer.inc';
?>
