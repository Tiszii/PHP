<?php
/*
 * 
Filter Name	Filter ID
int             257
boolean         258
float           259
validate_regexp	272
validate_domain	277
validate_url	273
validate_email	274
validate_ip	275
validate_mac	276
string          513
stripped	513
encoded         514
special_chars	515
full_special_chars	522
unsafe_raw	516
email           517
url             518
number_int	519
number_float	520
magic_quotes	521
callback	1024
 */

/*
 * Why use filters?
 * Many web applications receive external input. External input/data can be:

User input from a form
Cookies
Web services data
Server variables
Database query results
 */
/*
 * for validate an integer  
 * filter_var($int, FILTER_VALIDATE_INT) === true
 * 
 * for validate an integer with the 0
 * filter_var($int, FILTER_VALIDATE_INT) === 0 || filter_var($int, FILTER_VALIDATE_INT) === true
 * 
 * for validate ad ip address 
 * filter_var($ip, FILTER_VALIDATE_IP) === true
 * 
 * for sanitaze and validate ad email
 * $email = filter_var($email, FILTER_SANITIZE_EMAIL);  --> remove illegal caracters(html)
 * filter_var($email, FILTER_VALIDATE_EMAIL) === true
 * 
 * for sanitaze and validate an url
 * $url = filter_var($url, FILTER_SANITIZE_URL);  --> remove illegal caracters(html)
 * filter_var($url, FILTER_VALIDATE_URL) === true
 * 
 */
