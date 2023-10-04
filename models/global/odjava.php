<?php

session_start();

unset($_SESSION['korisnik']);
unset($_SESSION['admin']);
unset($_SESSION['korpasesijanarucivanjezastita']);
unset($_SESSION['uspeh']);
header("Location: ../../index.php?page=pocetna");
exit();

?>