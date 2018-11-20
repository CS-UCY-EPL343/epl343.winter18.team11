package c.tests.winter2018;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import java.sql.Connection;
import java.sql.PreparedStatement;

public class CreateAccount extends AppCompatActivity {
    private EditText Name;
    private EditText Surname;
    private EditText Email;
    private EditText ID;
    private EditText Password;
    private Button save;
    private Button cancel;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.create_account);
        Name = (EditText) findViewById(R.id.insertname);
        Surname = (EditText) findViewById(R.id.insertsurname);
        Email = (EditText) findViewById(R.id.insertemail);
        ID =(EditText)findViewById(R.id.insertid);
        Password = (EditText) findViewById(R.id.insertpassword);
        save=(Button)findViewById(R.id.createSave);
        cancel=(Button)findViewById(R.id.createcancel);

        save.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                SaveInfo inf= new SaveInfo();
                inf.execute();
                Intent intent = new Intent(CreateAccount.this, MainActivity.class);
                intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(intent);




            }
        });
        cancel.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                SaveInfo info= new SaveInfo();
                info.execute();

            }
        });








    }





    private class SaveInfo extends AsyncTask<String, String, String> {

        private String message = "Your Account has been created";    // The message for the Toast
        private String name;            // Name
        private String surname;         // Surname
        private int id;        // Date of birth
        private String email;           // Email
        private int pass;


        @Override
        protected String doInBackground(String... voids) {

            // establishing connection
            ConnectDB connection = new ConnectDB();
            Connection conn = connection.establishConnection();

            // If the connection failed
            if (conn == null) {
                message = "Please make sure you are connected";
                return message;
            }




            // Get the text of the fields
            name = Name.getText().toString();
            surname = Surname.getText().toString();
            pass = (int)Integer.parseInt(Password.getText().toString());
            String checkpass =Password.getText().toString();
            String idcheck =ID.getText().toString();
            id = (int)Integer.parseInt(ID.getText().toString());
            email = Email.getText().toString();

            // This query updates the database with the values of the fields
            String sql = "INSERT INTO `User`(`UserID`, `Email`, `Address`, `Password`, `Name`, " +
                    "`Surname`, `isCustomer`, `Rating`) VALUES (?,?,?,?,?,?,?,?)";
            PreparedStatement statement = null;

            try {
                // Create and execute statement
                statement = conn.prepareStatement(sql);

                if(name.equals("") || surname.equals("") || checkpass.equals("") || idcheck.equals("")|| email.equals("")){
                    // if some field is blank
                    message = "Please enter all the details...";
                }else{
                    // Set the strings in database
                    statement.setInt(1,id);
                    statement.setString(2,surname);
                    statement.setString(3,email);
                    statement.setInt(4,pass);
                    statement.setString(5,name);
                    statement.setString(6,surname);
                    statement.setInt(7,1);
                    statement.setInt(8,5);




                    statement.executeUpdate();
                }




            } catch (Exception ex) {
                message = "Have not saved...";
            }
            if(message.equals("Your Account has been created")){
                Intent intent = new Intent(CreateAccount.this, MainActivity.class);
                intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(intent);


            }



             return message;
        }

        @Override
        protected void onPostExecute(String z) {
            // wright the informing message whether everything was successful or not.
            Toast.makeText(CreateAccount.this, message, Toast.LENGTH_SHORT).show();

        }
    }

}
