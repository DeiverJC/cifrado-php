<?php
/**
 * encryptation of strign using SHA-1
 *
 * @param [string] $password
 * @return [String]
 */
function encryptSha1($password)
{
    return sha1($password);
}

/**
 * decryptation of strign using SHA-1
 *
 * @param [string] $password
 * @param [string] $dbpassword
 * @return [boolean]
 */
function decryptSha1($password, $dbpassword)
{
    if (sha1($password) == $dbpassword) {
        return true;
    }
    return false;
}

/**
 * encryptation of strign using MD5
 *
 * @param [string] $password
 * @return [String]
 */
function encryptMd5($password)
{
    return md5($password);
}

/**
 * decryptation of strign using SHA-1
 *
 * @param [string] $password
 * @param [string] $dbpassword
 * @return [boolean]
 */
function decryptMd5($password, $dbpassword)
{
    if (md5($password) == $dbpassword) {
        return true;
    }
    return false;
}

$salt = '$bgr$000/';
function encryptSalt($password)
{
    return md5($salt . $password);
}

function decryptSalt($password, $dbpassword)
{
    if (md5($salt . $password) == $dbpassword) {
        return true;
    }
    return false;
}
