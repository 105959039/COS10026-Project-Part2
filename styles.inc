//Index styles
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
           <style>
        
        .index_header {
            width: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('https://images.unsplash.com/photo-1518770660439-4636190af475?ixlib=rb-4.0.3&auto=format&fit=crop&w=1500&q=80');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 400px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            color: white;
            text-align: left;
            padding: 80px;
            margin-bottom: 30px;
        }
        
        .index_header h1 {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        index_h2 {
            color: #2c3e50;
            font-size: 2.2rem;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 3px solid #3498db;
            display: inline-block;
        }
        </styles>

        <style>
        #menu {
            width: 100%;
            background: linear-gradient(to right, #2c3e50, #3498db);
            padding: 15px 40px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 25px;
            position: fixed;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        #menu img {
            margin-right: 15px;
            height: 50px;
            width: auto;
            border-radius: 5px;
        }
        
        #menu a.ridge {
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: 10px 20px;
            text-decoration: none;
            font-weight: 600;
            border-radius: 30px;
            transition: all 0.3s ease;
        }
        
        #menu a.ridge:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }
    </style>

        
        body {
            background-color: #f8f9fa;
            color: #2c3e50;
            line-height: 1.6;
            padding-top: 80px;
        }
        

        section {
            padding: 60px 40px;
            margin: 30px auto;
            max-width: 1200px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            background: white;
        }
        
        
        #services {
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), 
                        url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1500&q=80');
            background-size: cover;
            background-attachment: fixed;
            text-align: center;
        }
        
        #services ul {
            list-style: none;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
        }
        
        #services li {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 15px 30px;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        #services li:hover {
            transform: translateY(-5px);
        }

      
        .container {
            width: 100%;
            margin-top: 30px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 25px;
        }
        
        .card {
            flex: 1;
            min-width: 280px;
            padding: 30px;
            color: white;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }
        
        .commitment {
            background: linear-gradient(135deg, #2c3e50 0%, #4a6491 100%);
        }
        
        .mission {
            background: linear-gradient(135deg, #10507a 0%, #187bcd 100%);
        }
        
        .vision {
            background: linear-gradient(135deg, #3498db 0%, #2ecc71 100%);
        }
        
        .card h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
        }
        
        
        #socials {
            padding: 40px;
        }
        
        .contact-map-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            justify-content: space-between;
        }
        
        .contact-info {
            flex: 1;
            min-width: 300px;
        }
        
        .contact-info p {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            font-size: 1.1rem;
        }
        
        .contact-info img {
            margin-right: 15px;
            width: 20px;
            height: 20px;
        }
        
        .map-container {
            flex: 1;
            min-width: 300px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .map-container iframe {
            width: 100%;
            height: 300px;
            border: none;
        }
        
      
        #contact {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            text-align: center;
            padding: 50px 40px;
        }
        
        #contact a {
            display: inline-flex;
            align-items: center;
            margin: 15px;
            padding: 12px 25px;
            background: white;
            color: #2c3e50;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        #contact a:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            color: #3498db;
        }
        
        #contact img {
            margin-right: 10px;
            width: 20px;
            height: 20px;
        }
        
        /* Next Button */
        .next-button {
            text-align: center;
            margin: 40px auto;
            max-width: 1200px;
            padding: 0 20px;
        }
        
        .next-button a {
            display: inline-block;
            padding: 16px 40px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.2rem;
            box-shadow: 0 6px 20px rgba(37, 117, 252, 0.3);
            transition: all 0.3s ease;
        }
        
        .next-button a:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(37, 117, 252, 0.5);
        }
        
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: #f8f9fa;
        color: #2c3e50;
        line-height: 1.6;
        padding-top: 80px;
    }

    /* Card CSS for About / Services section */
    .container {
        width: 100%;
        margin-top: 30px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 25px;
    }

    .card {
        flex: 1;
        min-width: 280px;
        padding: 30px;
        color: white;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    .commitment {
        background: linear-gradient(135deg, #2c3e50 0%, #4a6491 100%);
    }

    .mission {
        background: linear-gradient(135deg, #10507a 0%, #187bcd 100%);
    }

    .vision {
        background: linear-gradient(135deg, #3498db 0%, #2ecc71 100%);
    }

    .card h2 {
        font-size: 1.8rem;
        margin-bottom: 20px;
        border-bottom: 2px solid rgba(255, 255, 255, 0.3);
        color: white;
    }

    @media (max-width: 768px) {
        .header {
            padding: 40px;
            height: 300px;
        }

        .header h1 {
            font-size: 2.5rem;
        }

        .container {
            flex-direction: column;
        }

        .card {
            width: 100%;
            margin-bottom: 20px;
        }
    }
    <style>
        footer {
            background: linear-gradient(to right, #2c3e50, #3498db);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            margin-top: 40px;
        }
        
        .footer-left p {
            margin: 0;
            font-size: 1rem;
        }
        
        .footer-right a {
            display: inline-flex;
            align-items: center;
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 4px;
            transition: background 0.3s ease;
        }
        
        .footer-right a:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .footer-right img {
            margin-right: 8px;
            width: 20px;
            height: 20px;
        }
    </style>

</style>


//Jobs style
<?php
// style.inc - CSS styles for jobs page
?>
<style>
    /* Main Content Styles Only */

    * {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  margin: 0;
  background: linear-gradient(to bottom, #f8f9fa, #e9ecef);
  color: #2c3e50;
  line-height: 1.6;
  padding-top: 160px;
}

.main-header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
  color: white;
  z-index: 1000;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  height: 160px;
}

.header-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 30px 5%;
  height: 100px;
}

.logo-container {
  display: flex;
  align-items: center;
  gap: 15px;
}

.header-logo {
  height: 80px;
  width: auto;
}

.header-center {
  text-align: center;
  flex: 1;
  padding: 0 20px;
}

.header-center h1 {
  font-size: 2.2rem;
  margin-bottom: 8px;
  font-weight: 700;
}

.header-center p {
  font-size: 1.2rem;
  opacity: 0.9;
}

.apply-button {
  background: linear-gradient(to right, #ff7e5f, #feb47b);
  color: white;
  border: none;
  padding: 12px 25px;
  border-radius: 30px;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  text-decoration: none;
  display: inline-block;
  font-size: 1rem;
}

.apply-button:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
  background: linear-gradient(to right, #7bfe91, #5fff7c);
}

@media (max-width: 768px) {
  body { padding-top: 180px; }
  .main-header { height: 180px; }
  .header-content {
    flex-direction: column;
    text-align: center;
    gap: 15px;
    padding: 25px 5%;
    height: auto;
  }
  .header-center { order: -1; width: 100%; }
  .header-center h1 { font-size: 1.8rem; }
  .header-center p { font-size: 1.1rem; }
  .header-logo { height: 50px; }
  .apply-button {
    width: 100%;
    max-width: 250px;
    margin-top: 10px;
  }
}

@media (max-width: 480px) {
  body { padding-top: 200px; }
  .main-header { height: 200px; }
  .header-center h1 { font-size: 1.6rem; }
  .header-center p { font-size: 1rem; }
  .header-logo { height: 45px; }
  .apply-button {
    padding: 10px 20px;
    font-size: 0.9rem;
  }

  /* Menu-specific styles */
.top-nav {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 5%;
    height: 60px;
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    width: 100%;
}

.nav-buttons {
    display: flex;
    gap: 5px;
}

.nav-btn {
    background: rgba(255, 255, 255, 0.15);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.nav-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

.nav-btn.active {
    background: rgba(255, 255, 255, 0.25);
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
}

/* Responsive menu styles */
@media (max-width: 768px) {
    .top-nav {
        flex-direction: column;
        height: auto;
        padding: 10px 5%;
        gap: 10px;
    }
    
    .nav-buttons {
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .nav-btn {
        padding: 6px 12px;
        font-size: 0.9rem;
    }
}

@media (max-width: 480px) {
    .nav-btn {
        padding: 5px 10px;
        font-size: 0.8rem;
    }
    
    .nav-btn i {
        font-size: 0.9rem;
    }
}
}
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .content-wrapper {
        display: flex;
        gap: 30px;
    }
    
    .main-content {
        flex: 3;
        width: 75%;
        min-width: 300px;
    }
    
    .aside-container {
        flex: 1;
        width: 25%;
        min-width: 25%;
        max-width: 25%;
    }
    
    section {
        background: white;
        padding: 30px;
        margin-bottom: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease;
    }
    
    section:hover {
        transform: translateY(-5px);
    }
    
    aside {
        background: linear-gradient(to bottom, #4a6491, #2c3e50);
        color: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border: 3px solid #3498db;
        position: sticky;
        top: 100px;
    }
    
    aside h3 {
        color: #fff;
        border-bottom: 2px solid rgba(255, 255, 255, 0.3);
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    
    aside ul {
        list-style-type: none;
        margin-left: 0;
    }
    
    aside li {
        margin-bottom: 12px;
        padding-left: 25px;
        position: relative;
    }
    
    aside li:before {
        content: "•";
        color: #3498db;
        font-weight: bold;
        position: absolute;
        left: 0;
        font-size: 20px;
    }
    
    h2 {
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 3px solid #3498db;
        font-size: 1.8rem;
    }
    
    h3 {
        margin: 20px 0 15px;
        color: #3498db;
        font-size: 1.4rem;
    }
    
    h4 {
        margin: 20px 0 12px;
        color: #2c3e50;
        font-size: 1.2rem;
    }
    
    .decorative-bar {
        height: 6px;
        background: linear-gradient(to right, #6a11cb, #2575fc, #2c3e50);
        border-radius: 3px;
        margin: 15px 0 25px;
    }
    
    .highlight {
        background: linear-gradient(120deg, rgba(106, 17, 203, 0.1), rgba(37, 117, 252, 0.1));
        padding: 15px;
        border-radius: 8px;
        border-left: 4px solid #6a11cb;
    }
    
    .job-count {
        text-align: center;
        margin-bottom: 20px;
        font-size: 1.1rem;
        color: #2c3e50;
        background: white;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    @media (max-width: 992px) {
        .content-wrapper {
            flex-direction: column;
        }
        
        .main-content,
        .aside-container {
            width: 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }
        
        aside {
            position: relative;
            top: 0;
        }
    }
    
    @media (max-width: 768px) {
        section, aside {
            padding: 20px;
        }
    }
    
    @media (max-width: 480px) {
        section, aside {
            padding: 18px;
            margin: 15px 0;
        }
    }
    [5:10 PM, 11/15/2025] Shariar Shikto: <?php
// style.inc - CSS styles for jobs page
?>
<style>
    /* Main Content Styles Only */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .content-wrapper {
        display: flex;
        gap: 30px;
    }
    
    .main-content {
        flex: 3;
        width: 75%;
        min-width: 300px;
    }
    
    .aside-container {
        flex: 1;
        width: 25%;
        min-width: 25%;
        max-width: 25%;
    }
    
    section {
        background: white;
        padding: 30px;
        margin-bottom: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease;
    }
    
    section:hover {
        transform: translateY(-5px);
  …
[5:10 PM, 11/15/2025] Shariar Shikto: body css
[5:10 PM, 11/15/2025] Shariar Shikto: /* Footer Styles */
footer {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    padding: 40px 0 20px;
    margin-top: 50px;
    width: 100%;
}

.footer-content {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    gap: 30px;
}

.footer-section {
    flex: 1;
    min-width: 250px;
    margin-bottom: 20px;
}

.footer-section h3, 
.footer-section h4 {
    color: white;
    margin-bottom: 20px;
}

.footer-section p {
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 12px;
    line-height: 1.6;
}

.social-links {
    display: flex;
    gap: 12px;
    margin-top: 15px;
    flex-wrap: wrap;
}

.social-links a {
    color: white;
    font-size: 1.3rem;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.1);
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(255, 255, 255, 0.2);
    text-decoration: none;
}

/* Hover Colors */
.social-links a[href*="linkedin"]:hover { background: #0077b5; }
.social-links a[href*="twitter"]:hover { background: #1da1f2; }
.social-links a[href*="facebook"]:hover { background: #1877f2; }
.social-links a[href*="instagram"]:hover { background: #e4405f; }
.social-links a[href*="youtube"]:hover { background: #ff0000; }
.social-links a[href*="github"]:hover { background: #333; }

.social-links a:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    border-color: transparent;
}

.footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    padding-top: 20px;
    text-align: center;
    max-width: 1200px;
    margin: 30px auto 0;
    padding-left: 20px;
    padding-right: 20px;
}

.footer-bottom p {
    margin: 0;
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.8);
}

/* Responsive */
@media (max-width: 768px) {
    .footer-content {
        flex-direction: column;
        text-align: center;
    }

    .social-links {
        justify-content: center;
    }
}
</style>

//Apply styles
<style>
    <style>
    /* Header Styles */
    header {
      background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
      color: white;
      padding: 20px 5%;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      position: relative;
    }
    
    .logo-container {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 10px;
    }

    .logo {
       width: 120px;
       height: auto;
    }
    
    .logo-text {
      font-size: 18px;
      font-weight: bold;
      color: #2c3e50;
      text-align: center;
    }
    
    /* Navigation */
    nav {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 15px;
    }
    
    nav a {
      color: white;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 30px;
      background: rgba(255, 255, 255, 0.1);
      transition: all 0.3s ease;
      font-weight: 500;
    }
    
    nav a:hover {
      background: rgba(255, 255, 255, 0.2);
      transform: translateY(-2px);
    }
</style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
      color: #2c3e50;
      line-height: 1.6;
      padding: 0;
      margin: 0;
      min-height: 100vh;
    }
    
    /* Main Content */
    .container {
      max-width: 800px;
      margin: 30px auto;
      padding: 0 20px;
    }
    
    .form-container {
      background: white;
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      margin-bottom: 30px;
    }
    
    h1 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 30px;
      font-size: 2.2rem;
      position: relative;
      padding-bottom: 15px;
    }
    
    h1:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 100px;
      height: 4px;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      border-radius: 2px;
    }
    
    /* Form Elements */
    form {
      display: flex;
      flex-direction: column;
      gap: 25px;
    }
    
    .form-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    
    .form-row {
      display: flex;
      gap: 20px;
    }
    
    .form-row .form-group {
      flex: 1;
    }
    
    label {
      font-weight: 600;
      color: #2c3e50;
      font-size: 1.1rem;
    }
    
    input, select, textarea {
      padding: 15px;
      border: 2px solid #e2e8f0;
      border-radius: 8px;
      font-size: 16px;
      transition: all 0.3s ease;
      font-family: inherit;
    }
    
    input:focus, select:focus, textarea:focus {
      outline: none;
      border-color: #3498db;
      box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
    }
    
    select {
      background-color: #f8f9fa;
      cursor: pointer;
    }
    
    textarea {
      min-height: 120px;
      resize: vertical;
    }
    
    fieldset {
      border: 2px solid #e2e8f0;
      border-radius: 8px;
      padding: 20px;
    }
    
    legend {
      font-weight: 600;
      color: #2c3e50;
      padding: 0 10px;
      font-size: 1.1rem;
    }
    
    .radio-group, .checkbox-group {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 10px;
    }
    
    .radio-group label, .checkbox-group label {
      display: flex;
      align-items: center;
      gap: 8px;
      font-weight: normal;
      cursor: pointer;
    }
    
    input[type="radio"], input[type="checkbox"] {
      width: 20px;
      height: 20px;
      accent-color: #3498db;
    }
    
    /* Submit Button */
    .submit-btn {
      background: linear-gradient(to right, #6a11cb, #2575fc);
      color: white;
      border: none;
      padding: 16px;
      border-radius: 8px;
      font-size: 1.2rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 10px;
      box-shadow: 0 4px 10px rgba(37, 117, 252, 0.3);
    }
    
    .submit-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(37, 117, 252, 0.4);
    }
    
    /* Social Links */
    .social-links {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin: 30px 0;
    }
    
    .social-links a {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
      color: white;
      text-decoration: none;
      font-size: 24px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    
    .social-links a:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
      .form-row {
        flex-direction: column;
        gap: 15px;
      }
      
      .form-container {
        padding: 30px 20px;
      }
      
      h1 {
        font-size: 1.8rem;
      }
      
      nav {
        flex-direction: column;
        align-items: center;
      }
      
      nav a {
        width: 100%;
        text-align: center;
      }
    }
    
    @media (max-width: 480px) {
      .logo {
        width: 100px;
        height: 100px;
      }
      
      .logo-text {
        font-size: 16px;
      }
      
      h1 {
        font-size: 1.6rem;
      }
      
      input, select, textarea {
        padding: 12px;
      }
    }
    
    /* Decorative Elements */
    .required:after {
      content: " *";
      color: #e74c3c;
    }
    
    .form-section {
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 2px solid #f1f2f6;
    }
    
    .form-section-title {
      font-size: 1.3rem;
      color: #3498db;
      margin-bottom: 20px;
      padding-left: 10px;
      border-left: 4px solid #3498db;
    }
    
    /* Validation Styles */
    .error-message {
      color: #e74c3c;
      font-size: 14px;
      margin-top: 5px;
      display: none;
    }
    
    .fieldset-legend {
      font-weight: 600;
      color: #2c3e50;
      padding: 0 10px;
    }
    
    input:invalid, select:invalid {
      border-color: #e74c3c;
    }
    
    input:valid, select:valid {
      border-color: #2ecc71;
    }
    
    .age-error {
      color: #e74c3c;
      font-size: 14px;
      margin-top: 5px;
      display: none;
    }
    .large-textarea {
    width: 100%;          /* full width of container */
    min-height: 180px;    /* taller box */
    max-height: 300px;    /* prevents it from getting too tall */
    font-size: 16px;      /* readable text */
    padding: 15px;        /* consistent with other inputs */
    border-radius: 8px;   /* same style as other inputs */
    border: 2px solid #e2e8f0;
    resize: vertical;     /* user can resize vertically */
    font-family: inherit; /* matches other inputs */
}
<!-- footer.inc with styles -->
<style>
  footer {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    text-align: center;
    padding: 25px;
    margin-top: 40px;
  }

  footer p {
    margin: 0;
    font-size: 1.1rem;
  }
</style>
