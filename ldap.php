<?php
$ldap_dn1 = "cn=".$_POST["username"].",ou=Users,ou=Gruppe5.local,dc=Gruppe5,dc=local";
$ldap_dn2 = "cn=".$_POST["username"].",ou=administrator, ou=gruppe5.local,dc=gruppe5,dc=local";
$ldap_password = $_POST["password"];

# Die IP des ADDS Servers
$ldap_con = ldap_connect("ldap://192.168.102.10");
ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);

if ($ldap_password == NULL || ($ldap_dn1 == NULL && $ldap_dn2 == NULL)) {
    echo "Bitte geben Sie alle Anmeldedaten ein!";
} elseif ($ldap_dn1 != NULL && @ldap_bind($ldap_con, $ldap_dn1, $ldap_password)) {
    include("room.html");
    exit();
} elseif ($ldap_dn2 != NULL && @ldap_bind($ldap_con, $ldap_dn2, $ldap_password)) {
    header("Location: ./admin/index.html.");
    exit();
} else {
    echo "Ungültige Anmeldedaten";
}

?>