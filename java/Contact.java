package c.tests.winter2018;


/**
 * This class is responsible for the contact us page when the user is logged in.  With this
 * class the user is able to send an email to the manager that is responsible to check this emails.
 */

import android.os.AsyncTask;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentTransaction;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
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


public class Contact extends android.support.v4.app.Fragment implements View.OnClickListener {

    // Recipient's email ID needs to be mentioned.
    private static final String managerEmail = "kkekko02@cs.ucy.ac.cy";

    // given description
    private TextView description;

    // Sender's description
    private String user_description;
    // get an instance on the account the email will be send from that username
    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {

        View v = inflater.inflate(R.layout.contact, container, false);

        // sets the buttons
        //Button b_cancel = (Button) v.findViewById(R.id.cancel_but_contact_us);
        Button b_submit = (Button) v.findViewById(R.id.send);

        // adding listeners on the buttons
        //b_cancel.setOnClickListener(this);
        b_submit.setOnClickListener(this);
        return v;
    }

    @Override
    public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);

        getActivity().setTitle("Contact Us");

    }

    @Override
    public void onClick(View view) {

        // this switch is responsible for each button's actions
        switch (view.getId()) {

            case R.id.cancel:
                /*Fragment someFragment3 = new Home();
                MainActivity.navigationView.setCheckedItem(R.id.nav_home);
                MainActivity.last_id = 0;
                FragmentTransaction transaction3 = getFragmentManager().beginTransaction();
                transaction3.replace(R.id.contact_us_layout, someFragment3);
                transaction3.addToBackStack(null);  // if written, this transaction will be added to backstack
                transaction3.commit();*/
                break;

            case R.id.send:
                setTextViews();
                SendEmail email = new SendEmail();
                email.execute();

                break;


        }
    }

    /*
     * This method is responsible to set the texviews and the strings that will be sent on the
     * email.
     */
    private void setTextViews() {
        this.description = (EditText) getView().findViewById(R.id.description);
        this.user_description = this.description.getText().toString();
    }

    /*
  * This class is responsible for sending an email from the user that is not logged in to the
  * manager that is responsible to read those messages.
  */
    private class SendEmail extends AsyncTask<String, String, String> {

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
                message.setFrom(new InternetAddress("skousp01@cs.ucy.ac.cy"));

                // Set To: header field of the header.
                message.addRecipient(Message.RecipientType.TO, new InternetAddress(managerEmail));

                // Set Subject: header field
                message.setSubject("Emira Pottery: Contact Us");

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
    }
}