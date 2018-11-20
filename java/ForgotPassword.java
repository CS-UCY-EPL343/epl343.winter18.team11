package c.tests.winter2018;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import java.util.Properties;

import javax.mail.Message;
import javax.mail.MessagingException;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeMessage;

public class ForgotPassword extends AppCompatActivity {
    private String email;
    private EditText takeemail;
    private Button cancel;
    private Button send;
    private Integer newpass;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.forgot_password);

        takeemail=(EditText)findViewById(R.id.emailnewpass);
        cancel=(Button)findViewById(R.id.cancelnewpass);
        send=(Button)findViewById(R.id.newpass);
         cancel.setOnClickListener(new View.OnClickListener() {
             @Override
             public void onClick(View v) {
                 Intent intent = new Intent(ForgotPassword.this, MainActivity.class);
                 intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                 intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                 startActivity(intent);
             }
         });

        send.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                newpass= (int)((Math.random()+10000000)*99999999);
                String pa=newpass.toString();
                Toast.makeText(ForgotPassword.this, pa, Toast.LENGTH_SHORT).show();
                //SendEmail send = new SendEmail();
                //send.execute;
                /*Intent intent = new Intent(ForgotPassword.this, MainActivity.class);
                intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(intent);*/
            }
        });





    }




   /* private class SendEmail extends AsyncTask<String, String, String> {

        private String z = "Your email has been sent"; // the informing message
        private static final String TAG = "Emirra"; // the logcat tag

        @Override
        protected String doInBackground(String... strings) {
            // Assuming you are sending email from localhost
            String host = "mail-out.cs.ucy.ac.cy";

            // Get system properties
            Properties properties = System.getProperties();

            // Setup mail server
            properties.setProperty("mail.smtp.host", host);

            // Get the default Session object.
            Session session = Session.getDefaultInstance(properties);

            try {
                // Create a default MimeMessage object.
                MimeMessage message = new MimeMessage(session);

                // Set From: header field of the header.
                message.setFrom(new InternetAddress("kkekko0201@cs.ucy.ac.cy"));

                // Set To: header field of the header.
                message.addRecipient(Message.RecipientType.TO, new InternetAddress(email));

                // Set Subject: header field
                message.setSubject("Emira Pottery: New Password");

                // the given message
                message.setText(user_description);

                // Send message
                Transport.send(message);
            } catch (MessagingException ex) {
                Log.e(TAG, ex.getMessage());
                Toast.makeText(getActivity(), "nop", Toast.LENGTH_SHORT).show();

            }
            return null;
        }

        @Override
        protected void onPostExecute(String x) {
            // write the informing message whether everything was successful or not.
            Toast.makeText(getActivity(), z, Toast.LENGTH_SHORT).show();

        }
    }*/

}
