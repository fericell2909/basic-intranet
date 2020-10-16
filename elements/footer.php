<?php
if (isset($_SESSION['id'])):
    ?>
    <footer>
        <div class="copyright-info">
            <p class="pull-right">
                Powered by <a href="https://www.facebook.com/cpcha94" target="_blank">Pablo Chávez</a>
            </p>
        </div>
        
    </footer>
    <?php
else:
    header('location: ../403.php');
endif;