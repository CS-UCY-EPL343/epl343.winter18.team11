package c.tests.winter2018;

import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.AsyncTask;
import android.os.Bundle;

import java.util.Properties;

import javax.mail.*;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeMessage;

import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.util.Log;
import android.widget.Button;

import android.widget.TextView;
import android.widget.Toast;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import android.app.DatePickerDialog;
import android.widget.DatePicker;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.GregorianCalendar;

import java.util.ArrayList;
import java.util.LinkedList;

import static java.lang.Math.abs;



public class Meeting extends Fragment  {

    private static final String TAG = "Meeting";
    private static Connection conn = null;

    //These variables are used for the Date Picker
    private TextView mDisplayDate;
    private TextView mDisplayDate2;
    private DatePickerDialog.OnDateSetListener mDateSetListener;
    private DatePickerDialog.OnDateSetListener mDateSetListener2;

    private Calendar FromD = new GregorianCalendar();
    private Calendar ToD = new GregorianCalendar();
    private String fromd;
    private String tod;

    //This is the username of the manager that is log in
    private String username;
    //This is the content of the email with the right format
    private String selectContent;

    //Variables that are used for the data that we retrieve from the database
    private String Name;
    private String ID;
    private String Username;
    private String Surname;
    private String Salary;


    private String ClockIn ;
    private String ClockOut;
    private String BreakLength;




    int year1;
    int month1;
    int day1;
    int breakduration;


    String tempUsername;
    String testUsername;

    // Sender's description
    private static final String managerEmail = "kkekko02@cs.ucy.ac.cy";


    Button createJSON;
    Button createXML;


    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {

        View v = inflater.inflate(R.layout.meeting, container, false);

        return v;
    }

    /**
     * In this method we set the actions that
     * must be made in case the user press
     * any of the buttons or text box of the page.
     * @param view
     * @param savedInstanceState
     */
    public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);



        getActivity().setTitle("Payroll Report");

        //set the view for the buttons to export xml/json
        createJSON = (Button) getActivity().findViewById(R.id.json);

        //set the view, for the selection of the days
        mDisplayDate = (TextView) getActivity().findViewById(R.id.Date1);


        //From this date that the user will select we will start the payroll report
        mDisplayDate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Calendar cal1 = Calendar.getInstance();
                year1 = cal1.get(Calendar.YEAR);
                month1 = cal1.get(Calendar.MONTH);
                day1 = cal1.get(Calendar.DAY_OF_MONTH);



                DatePickerDialog dialog = new DatePickerDialog(
                        view.getContext(),
                        android.R.style.Theme_Holo_Light_Dialog_MinWidth,
                        mDateSetListener,
                        year1, month1, day1);
                dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
                dialog.show();
            }
        });

        //The month in calendar starts from the zero, that's why we plus 1 for the print
        mDateSetListener = new DatePickerDialog.OnDateSetListener() {
            @Override
            public void onDateSet(DatePicker datePicker, int year1, int month1, int day1) {
                FromD.set(year1, month1, day1);
                month1 = month1 + 1;
                fromd = year1 + "-" + month1 + "-" + day1;

                Log.d(TAG, "onDateSet: mm/dd/yyy: " + month1 + "/" + day1 + "/" + year1);
                String date = day1 + "/" + month1 + "/" + year1;
                mDisplayDate.setText(date);
            }
        };





        createJSON.setOnClickListener((new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                int flag=1;
                if (FromD.get(Calendar.YEAR) > ToD.get(Calendar.YEAR)) {
                    flag = 0;

                }
                if (FromD.get(Calendar.YEAR) == ToD.get(Calendar.YEAR)) {
                    if ( FromD.get(Calendar.MONTH)> ToD.get(Calendar.MONTH) ) {
                        flag = 0;

                    } else if (FromD.get(Calendar.MONTH) == ToD.get(Calendar.MONTH)) {
                        if (FromD.get(Calendar.DAY_OF_MONTH) > ToD.get(Calendar.DAY_OF_MONTH)) {
                            flag = 0;
                        }
                    }

                }
                if( mDisplayDate.length()==0 || mDisplayDate2.length()==0){
                    flag=0;
                }

                if(flag==0){
                    flag=1;
                    Toast.makeText(getContext(), "Please insert Valid dates",Toast.LENGTH_SHORT).show();
                    mDisplayDate.setText(null);
                    mDisplayDate2.setText(null);
                }
                else{


                    SendEmail email = new SendEmail();
                    email.execute(); }


            }


        }));




    }



    /**
     * This method is responsible to connect with the
     * database and retrieve the information about the
     * employees.


    protected Void FindEmployees() {
        //Connect with the databse
        ConnectDB connection = new ConnectDB();
        conn = connection.establishConnection();


        Account account = Account.getUniqueInstance();
        //Take the username of the manager
        username = account.getUsername();
        //we retrieve the employees that they have as manager the manager that is log in
        String query = "Select*FROM  `Employee`  WHERE  `UsernameManager` = '" + username + "'";
        PreparedStatement stmt = null;


        if (conn == null) {
            return null;
        }
        try {

            stmt = conn.prepareStatement(query);
            ResultSet rs = stmt.executeQuery(query);


            while (rs.next()) {
                Name = rs.getString("Name");
                Username = rs.getString("Username");
                ID = rs.getString("ID");
                Surname = rs.getString("Surname");
                Salary = rs.getString("Salary");

                createEmployeeList(Name, Username, ID, Surname, Salary);


            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;


    }
*/








    /** In this class we send an email to the chosen person
     *  with the information of the payroll report
     *  in the format that the manager has selected
     *
     */
    private class SendEmail extends AsyncTask<String, String, String> {

        private String z = "Your email has been sent"; // the informing message
        private static final String TAG = "Statare"; // the logcat tag


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
                message.setSubject("Statare: Payroll Report");

                // the given message
                message.setText(selectContent);

                // Send message
                Transport.send(message);
            } catch (MessagingException ex) {
                Log.e(TAG, ex.getMessage());
                z="Your email has not been sent";
            }

            return null;
        }

        @Override
        protected void onPostExecute(String x) {
            // write the informing message whether everything was successful or not.
            Toast.makeText(getContext(), z, Toast.LENGTH_SHORT).show();

        }
    }

    /**
     * This class help us keep the information
     * we retrieve from the database the first time
     */




}





































