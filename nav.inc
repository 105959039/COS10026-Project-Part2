<div id="menu">
    <img src="QAE logo.png" alt="Logo">
    <a class="ridge" href="index.php">Home</a>
    <a class="ridge" href="about.php">About</a>
    <a class="ridge" href="services.php">Services</a>
    <a class="ridge" href="jobs.php">Careers</a>
    <a class="ridge" href="contact.php">Contact</a>
    <a class="ridge" href="manage.php">Login</a>
</div>
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