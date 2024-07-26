<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard with Sidebar and Dropdown Icons</title>
    <script src="nbu_load.js"></script>
    <script src="antinato_load.js"></script>
    <script src="postnato_load.js"></script>
    <script src="female_ward_load.js"></script>
    <script src="male_ward_load.js"></script>
    <script src="casualty_load.js"></script>
    <script src="paediactric_load.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        #navbar {
            background-color: #333;
            color: white;
            padding: 5px 10px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 30px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        #navbar img {
            margin-right: 6%;
            height: 30px;
            width: auto;
            cursor: pointer;
        }
        #sidebar {
            background-color: #f1f1f1;
            width: 200px;
            position: fixed;
            top: 40px;
            bottom: 0;
            left: 0;
            overflow-y: auto;
            padding: 20px;
        }
        #sidebar h3 {
            margin-top: 0;
        }
        #sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        #sidebar ul li {
            margin-bottom: 10px;
        }
        #sidebar ul li a {
            text-decoration: none;
            color: #333;
        }
        #main-content {
            margin-left: 220px;
            padding: 20px;
            margin-top: 40px;
        }
        #icon-container {
            margin-right: -1%;
            display: none;
            position: absolute;
            top: 40px;
            right: 10%;
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .icon-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
        }
        .icon-item {
            display: flex;
            align-items: center;
        }
        .icon-item img {
            height: 30px;
            width: auto;
            margin-right: 10px;
        }
        .icon-item span {
            font-size: 14px;
        }
        .load-content {
            padding-top: 40px; /* To account for the fixed navbar */
        }
        #profile-container {
            margin-right: -4%;
            display: none;
            position: absolute;
            top: 40px;
            right: 5%;
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <nav id="navbar">
        <img src="./icons/dashboard.png" alt="Dashboard Icon" id="dashboard-icon">
        <img style="margin-right: 5%;" src="./icons/profile.png" alt="Profile Icon" id="profile-icon">
    </nav>
    
    <div class="load-content">
        <div id="sidebar">
            <h3>Sidebar</h3>
            <!-- <ul>
                <li><a href="#" id="dashboard-link">Dashboard</a></li>
                <li><a href="#" id="users-link">Users</a></li>
            </ul> -->
        </div>
    
        <div id="icon-container">
            <div class="icon-container">
                <div class="icon-item">
                    <img src="./icons/dashboard.png" alt="MCH Icon">
                    <span><a href="nbu.html">NBU</a></span>
                </div>
                <div class="icon-item">
                    <img src="./icons/dashboard.png" alt="Anti-natal Icon">
                    <span><a href="antinato.html">Ante-Natal</a></span>
                </div>
                <div class="icon-item">
                    <img src="./icons/dashboard.png" alt="Post-natal Icon">
                    <span><a href="postnato.html">Post-Natal</a></span>
                </div>
                <div class="icon-item">
                    <img src="./icons/dashboard.png" alt="Female Ward Icon">
                    <span><a href="female_ward.html">Female Ward</a></span>
                </div>
                <div class="icon-item">
                    <img src="./icons/dashboard.png" alt="Male Ward Icon">
                    <span><a href="male_ward.html">Male Ward</a></span>
                </div>
                <div class="icon-item">
                    <img src="./icons/dashboard.png" alt="Male Ward Icon">
                    <span><a href="casualty.html">Casualty</a></span>
                </div>
                <div class="icon-item">
                    <img src="./icons/dashboard.png" alt="Male Ward Icon">
                    <span><a href="paediactric.html">Paediactric</a></span>
                </div>
            </div>
        </div>

        <div id="profile-container">
            <div class="icon-container">
                <div class="icon-item">
                    <img src="./icons/profile.png" alt="Profile Icon">
                    <span><a href="profile.php" id="profile">Profile</a></span>
                </div>
                <div class="icon-item">
                    <img src="./icons/setting.png" alt="Settings Icon">
                    <span><a href="settings.html" id="user-setting">Settings</a></span>
                </div>
                <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'): ?>
                <div class="icon-item">
                    <img src="./icons/user.png" alt="Users Icon">
                    <span><a href="users.html" id="users-link">Users</a></span>
                </div>
                <?php endif; ?>
                <div class="icon-item">
                    <img src="./icons/logout.png" alt="Logout Icon">
                    <span><a href="logout.php" id="logout">Logout</a></span>
                </div>
            </div>
        </div>

        <div id="main-content">
            <h1>Main Content Area</h1>
            <p>This is where the main content of your page will go.</p>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('dashboard-icon').addEventListener('click', function() {
                var container = document.getElementById('icon-container');
                container.style.display = container.style.display === 'none' || container.style.display === '' ? 'block' : 'none';
            });

            document.getElementById('profile-icon').addEventListener('click', function() {
                var container = document.getElementById('profile-container');
                container.style.display = container.style.display === 'none' || container.style.display === '' ? 'block' : 'none';
            });

            var usersLink = document.getElementById('users-link');
            if (usersLink) {
                usersLink.addEventListener('click', function(event) {
                    event.preventDefault();
                    fetch('users.html')
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('main-content').innerHTML = data;
                        })
                        .catch(error => console.error('Error loading users.html:', error));
                });
            }

            var userSetting = document.getElementById('user-setting');
            if (userSetting) {
                userSetting.addEventListener('click', function(event) {
                    event.preventDefault();
                    fetch('settings.html')
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('main-content').innerHTML = data;
                        })
                        .catch(error => console.error('Error loading settings.html:', error));
                });
            }

            var profile = document.getElementById('profile');
            if (profile) {
                profile.addEventListener('click', function(event) {
                    event.preventDefault();
                    fetch('profile.php')
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('main-content').innerHTML = data;
                        })
                        .catch(error => console.error('Error loading profile.php:', error));
                });
            }
        });
    </script>
</body>
</html>
