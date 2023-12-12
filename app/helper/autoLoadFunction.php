<?php
    function autoLoadJs($filePath) {
        print '<script src="../js/'.$filePath.'"></script>';
        print '<script src="js/'.$filePath.'"></script>';
    }