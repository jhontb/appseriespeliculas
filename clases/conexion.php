

<?php
try {
    $con = new PDO('mysql:host=localhost;dbname=peliculasseries','root', '');

    
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>