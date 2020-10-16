<?php
if (isset($_SESSION['id'])):
    ?>
    <footer>
        <div class="copyright-info">
            <p class="pull-right">
            © <?php echo date('Y');?> <a href="https://github.com/fericell2909" target="_blank"> Desarrolladores de Software</a>
            </p>
        </div>
        
    </footer>
    <?php
else:
    header('location: ../403.php');
endif;