package c.tests.winter2018;

import android.content.Context;
import android.content.SharedPreferences;


/**
 * This class saves the account and every information of that account. It has a
 * singleton instance because only one account should be created in the application. It
 * has all the get and set methods for all the fields.
 */

public class Account {

    private static Account uniqueInstance = null; // The singleton instance
    private String username = null; // The account's username
    private String password = null; // The account's password
    private String role = "0"; // the user's role, 0 for employee and 1 for manager
    private String email = null; // the user's email
    private String state="CLOCKED OUT"; //the user's state



    static final String MY_PREF = "Properties";




    /**
     * This method checks if the unhashed password that the user gave is the correct by comparing
     * the unhashed password with the existing hashed password in the database (it takes it through
     * the parameter).
     *
     * @param password, the unhashed password that the user gave.
     * @param hashed,   the existing hashed password that is in the database
     * @return true, if they match, otherwise it returns false.
     */
    /*static boolean checkHashedPassword(String password, String hashed) {

        // Check that an unencrypted password matches one that has
        // previously been hashed
        if (BCrypt.checkpw(password, hashed))
            return true;
        return false;
    }
    */

    /**
     * This is the method that creates the singleton instance if this is the first
     * time that one class tries to create an object of this class.
     *
     * @return the instance.
     */
    public static Account getUniqueInstance() {

        if (uniqueInstance == null)
            uniqueInstance = new Account();

        return uniqueInstance;
    }

    /*
     * This is the private constructor of this class. It exists only to defeat
     * instatiation.
     */
    private Account() {
    }

    /**
     * This is the set method for the account's username.
     *
     * @param username, the account's username.
     */
    public void setAccountUsername(String username) {
        this.username = username;
    }

    /**
     * This is the set method for the account's email.
     *
     * @param email, the account's email.
     */
    public void setEmail(String email) {
        this.email = email;
    }

    /**
     * This is the set method for the account's password.
     *
     * @param password, the account's password.
     */
    public void setPassword(String password) {
        this.password = password;
    }

    /**
     * This is the set method for the user's role.
     *
     * @param role, the account's role.
     */
    public void setRole(String role) {
        this.role = role;
    }

    /**
     * It passes the account's role.
     *
     * @return the account's role.
     */
    public String getRole() {
        return this.role;
    }

    /**
     * It passes the account's username.
     *
     * @return the account's username.
     */
    public String getUsername() {
        return this.username;
    }

    /**
     * It passes the account's password.
     *
     * @return the account's password.
     */
    public String getPassword() {
        return this.password;
    }

    /**
     * It passes the account's email.
     *
     * @return the account's email.
     */
    public String getEmail() {
        return this.email;
    }











}

