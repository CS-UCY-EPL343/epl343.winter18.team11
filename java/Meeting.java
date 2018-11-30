package c.tests.Team11;

import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.AsyncTask;
import android.os.Bundle;

import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.Statement;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
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
import android.widget.ArrayAdapter;
import android.widget.Button;

import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import java.sql.Connection;

import android.app.DatePickerDialog;
import android.widget.DatePicker;

import java.util.Calendar;
import java.util.GregorianCalendar;

import static java.lang.Math.abs;

/** This class is responsible for letting the user
 * choose a day for a lesson meeting. The user
 * can choose a day and time for the lesson
 * and this class will send an email to the admin
 * and also update the database with the new meeting.
 */

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



    int year1;
    int month1;
    int day1;
    java.sql.Time time;


    // Sender's description
    private static final String managerEmail = "kkekko02@cs.ucy.ac.cy";


    Button selectmeeting;
    Button createXML;
    Account account= Account.getUniqueInstance();
    java.sql.Date sqlStartDate;
    String getdate;


    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {

        View v = inflater.inflate(c.tests.Team11.R.layout.meeting, container, false);

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



        getActivity().setTitle("Make an Appointment");


        //set the view for the buttons to export xml/json
        selectmeeting = (Button) getActivity().findViewById(c.tests.Team11.R.id.selectmeeting);

        //set the view, for the selection of the days
        mDisplayDate = (TextView) getActivity().findViewById(c.tests.Team11.R.id.Date1);


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
                getdate = day1+"-"+ month1+"-"+year1;
                mDisplayDate.setText(date);

            }
        };







        String[] arraySpinner = new String[] {
                "14:00:00", "14:30:00", "15:00:00", "15:30:00",
        };
        final Spinner s = (Spinner) getActivity().findViewById(c.tests.Team11.R.id.spinner);
        ArrayAdapter<String> adapter = new ArrayAdapter<String>(getActivity(),
                android.R.layout.simple_spinner_item, arraySpinner);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        s.setAdapter(adapter);



            selectmeeting.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    if(account.getIscustomer().equals("2")){
                        Toast.makeText(getActivity(),"Please log in first.", Toast.LENGTH_SHORT).show();
                    }
                    else{
                        String gettime=s.getSelectedItem().toString();

                        DateFormat format = new SimpleDateFormat("hh:mm:ss");
                        try {



                            java.util.Date d1 =(java.util.Date)format.parse(gettime);

                             time = new java.sql.Time(d1.getTime());
                        } catch(Exception e) {

                            Log.e("Exception is ", e.toString());
                        }


                        CheckMeeting meet = new CheckMeeting();
                        meet.execute();

                    }
                }
            });
    }





    private class CheckMeeting extends AsyncTask<String, String, String> {

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



                //String startDate="01-02-2013";
                SimpleDateFormat sdf1 = new SimpleDateFormat("dd-MM-yyyy");
                try {
                    Date getday = sdf1.parse(getdate);
                    sqlStartDate = new java.sql.Date(getday.getTime());

                } catch (ParseException e) {
                    e.printStackTrace();
                }






                // The query for login
                String query = "SELECT * FROM Meeting WHERE Date='"+fromd+"' AND Time='"+ time+"'";
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(query);

                // if the user exists
                if (rs.next()) {
                    message="Please select another time";

                } else {
                    message = "We have book your appointment";
                    SendEmail email = new SendEmail();
                    email.execute();
                    //to save the meeting to the database




                    String sql = "INSERT INTO `Meeting`(`MeetingID`, `Date`, `UserID`, `Time`)VALUES (?,?,?,?)";
                    PreparedStatement statement = null;
                    int x = 0;

                    try {
                        // Create and execute statement
                        statement = conn.prepareStatement(sql);


                            // Set the strings in database
                            statement.setNull(1,x);
                            statement.setDate(2,sqlStartDate);
                            statement.setInt(3, account.getId());
                            statement.setTime(4, time);


                            statement.executeUpdate();



                    } catch (Exception ex) {
                        message = ex.toString();
                    }




                }
            } catch (Exception ex) {
                message = ex.getMessage();
            }

            return message;
        }


        @Override
        protected void onPostExecute(String z) {
            // wright the informing message whether everything was successful or not.
            Toast.makeText(getActivity(), message, Toast.LENGTH_SHORT).show();
        }

    }





    /** In this class we send an email to the chosen person
     *  with the information of the payroll report
     *  in the format that the manager has selected
     *
     */
    private class SendEmail extends AsyncTask<String, String, String> {

        private String z = "Your email has been sent"; // the informing message
        private static final String TAG = "Emira"; // the logcat tag


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
                message.setFrom(new InternetAddress("kkekko02@cs.ucy.ac.cy"));

                // Set To: header field of the header.
                message.addRecipient(Message.RecipientType.TO, new InternetAddress("kkekko02@cs.ucy.ac.cy"));

                // Set Subject: header field
                message.setSubject("Emira Meeting");

                // the given message
                message.setText("New meeting with "+ account.getName() + " "+account.getSurname()+ "at"+fromd +" " +time);

                // Send message
                Transport.send(message);
            } catch (MessagingException ex) {
                Log.e(TAG, ex.getMessage());
                //z="Your email has not been sent";
            }

            return null;
        }

        @Override
        protected void onPostExecute(String x) {
            // write the informing message whether everything was successful or not.
            //Toast.makeText(getContext(), z, Toast.LENGTH_SHORT).show();

        }
    }



}





































