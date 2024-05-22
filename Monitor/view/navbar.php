
<h1>Welkom bij Rijschool XYZ</h1>
        <p>We bieden kwalitatieve rijlessen tegen goede prijzen, met ervaren instructeurs.</p>

        <nav>
            <ul>
                <li><a href="#contact">Contact</a></li>
                <?php
                session_start();
                if(isset($_SESSION['user_name'])) {
                    echo "<li><a href='./template/profiel.php'>Welkom, {$_SESSION['user_name']}</a></li>"; 
                    echo "<li><a href='../template/logout.php'>Uitloggen</a></li>";
                } else {
                    echo "<li><a href='./template/login.php'>Inloggen</a></li>";
                }
                ?>
            </ul>
        </nav>