<?php
	
	$ldap_dn1 = "cn=".$_POST["username"].",ou=Benutzer,ou=CSBE.LOCAL,dc=csbe,dc=local";
	$ldap_dn2 = "cn=".$_POST["username"].",ou=Administrator, ou=CSBE.LOCAL,dc=csbe,dc=local";
	$ldap_password = $_POST["password"];
	
	$ldap_con = ldap_connect("ldap://192.168.178.10");
	ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
	
	
	if ($ldap_password == NULL || ($ldap_dn1 == NULL && ldap_dn2 == NULL)) {
		echo "Bitte geben Sie alle Anmeldedaten ein!";
	} elseif ($ldap_dn1 != NULL && @ldap_bind($ldap_con, $ldap_dn1, $ldap_password)) {
		include("home.php");
		exit();
	} elseif ($ldap_dn2 != NULL && @ldap_bind($ldap_con, $ldap_dn2, $ldap_password)) {
		header("Location: ./admin/home.php.");
		exit();
	} else {
		echo "Ungültige Anmeldedaten";
	}
	
?>