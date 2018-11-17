package c.tests.winter2018;

/**
 * This class implements the login in the application. Firstly, checks the
 * username and password that the user inserts. If the username and password
 * are correct - there are in the database, the user logs into the system.
 *
 */

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.Toast;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Statement;

public class Login extends AppCompatActivity {

    // The connection for the database
    private static Connection conn = null;

    // The username that the user gives as an input
    private EditText usernameText;
    // The password that the user gives as an input
    private EditText passwordText;
    // The login button
    private Button buttonLogin;
    // The image button for the contact us
    private ImageButton contactBut;
    private Button forgot;
    private Button create;


    private Button cancel;

    // The String of EditText
    private String userName, password;

    // Reference to the inner class checkLogin
    private CheckLogin checkLogin;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.login);
        setupUIviews();

        // Button for the layout Contact Us - Out


        // if the credentials are correct, the user logs into the application
        buttonLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                if (validate()) {
                    checkLogin = new CheckLogin();
                    checkLogin.execute();
                }
            }
        });
        cancel.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(Login.this, MainActivity.class);
                intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(intent);


            }
        });
       create.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(Login.this, CreateAccount.class);
                intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(intent);


            }
        });
        forgot.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(Login.this, ForgotPassword.class);
                intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(intent);




            }
        });
    }

    // Set up the Edit Texts of the Login Layout
    private void setupUIviews() {
        usernameText = (EditText) findViewById(R.id.usename_login);
        passwordText = (EditText) findViewById(R.id.password_login);
        buttonLogin = (Button) findViewById(R.id.login_button);
        cancel=(Button)findViewById(R.id.cancel_button);
        forgot=(Button)findViewById(R.id.forgot_pass_button);
       create=(Button)findViewById(R.id.createaccount);

    }

    /*
     * Checks if the user do not enter the credentials.
     * It returns true if the credentials are correct, otherwise it returns false;
     */
    private Boolean validate() {
        Boolean result = false;

        userName = usernameText.getText().toString();
        password = passwordText.getText().toString();

        if (userName.isEmpty() || password.isEmpty()) {
            Toast.makeText(this, "Please enter all the details...", Toast.LENGTH_SHORT).show();
        } else {
            result = true;
        }
        return result;
    }

    /*
     * Firstly, this class connects with the database. Then it checks if the username
     * and password, that the user entered, are the same with the record that exists in the database.
     */
    private class CheckLogin extends AsyncTask<String, String, String> {

        String message = "Try Again! Invalid Credentials";        // The message for the Toast


        /**
         * This method is happening on the background, it checks the saved credentials if they are
         * matching with the existing records on the database.
         * @param params
         * @return null
         */
        protected String doInBackground(String... params) {

            try {
                // Create the connection with database
                ConnectDB connection = new ConnectDB();
                conn = connection.establishConnection();

                // If the connection failed
                if (conn == null) {
                    message = "Please check your connection!";
                    return message;
                }


                // The query for login
                String query = "SELECT * FROM User WHERE UserID='" + userName + "' AND Password= '" + password + "'";
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(query);

                // if the user exists
                if (rs.next()) {



                        message = userName;

                        // creates the session and sets the user's username and password
                        Account account = Account.getUniqueInstance();
                        account.setAccountUsername(userName);

                        String iscustomer = null;

                        iscustomer = rs.getString("IsCustomer");

                        // sets the user's email and role
                        //account.setRole(ismanager);
                        //account.setEmail(email);

                        // navigates into the home page
                   message = iscustomer;

                    Intent intent = new Intent(Login.this, MainActivity.class);
                        intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                        intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                        startActivity(intent);


                } else {
                    message = "Try Again! Invalid Credentials";
                }
            } catch (Exception ex) {
                message = ex.getMessage();
            }

            return message;
        }


        @Override
        protected void onPostExecute(String z) {
            // wright the informing message whether everything was successful or not.
            Toast.makeText(Login.this, z, Toast.LENGTH_SHORT).show();
        }

    }
}